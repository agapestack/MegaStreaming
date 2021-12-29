<?php

namespace App\Jobs;

use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

use App\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ConvertVideoForStreaming implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $video;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        Log::info('Transcoding started...');

        $lowBitrate = (new \FFMpeg\Format\Video\X264)->setKiloBitrate(250);
        $midBitrate = (new \FFMpeg\Format\Video\X264)->setKiloBitrate(500);
        $highBitrate = (new \FFMpeg\Format\Video\X264)->setKiloBitrate(1000);

        $media = FFMpeg::open('videos/' . $this->video->filepath);
        $durationInSeconds = $media->getDurationInSeconds();

        FFMpeg::fromDisk($this->video->disk)
            ->open('videos/' . $this->video->filepath)
            ->exportForHLS()
            ->setSegmentLength(10) // optional
            ->setKeyFrameInterval(48) // optional
            ->addFormat($lowBitrate, function ($media) {
                $media->scale(320, 240);
            })
            ->addFormat($midBitrate, function ($media) {
                $media->scale(720, 480);
            })
            ->addFormat($highBitrate, function ($media) {
                $media->scale(1080, 720);
            })
            ->save("transcoded_videos/" . $this->video->uuid . "/" . "playlist.m3u8");

        if ($durationInSeconds > 10) {
            // Video Preview Generation
            $start = \FFMpeg\Coordinate\TimeCode::fromSeconds(5);
            $end = \FFMpeg\Coordinate\TimeCode::fromSeconds(10);

            $clipFilter = new \FFMpeg\Filters\Video\ClipFilter($start, $end);
            FFMpeg::fromDisk($this->video->disk)
                ->open('videos/' . $this->video->filepath)
                ->export()
                ->addFilter($clipFilter)
                ->inFormat(new \FFMpeg\Format\Video\WebM)
                ->save("preview_videos/" . $this->video->filepath);
        }

        // Thumbnail Preview Generation
        // FFMpeg::fromDisk($this->video->disk)
        //     ->open('videos/' . $this->video->filepath)
        //     ->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds(10))
        //     ->save($this->video->uuid . '.jpg');
        // }

        $this->video->processed = true;
        $this->video->duration = $durationInSeconds;
        $this->video->save();
    }
}
