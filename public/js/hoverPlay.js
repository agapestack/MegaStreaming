function playVideo(vid) {
  // console.log('play video');
  // console.log(vid);
  videojs(vid).ready(function() {
    var player = this;
    // console.log(player);
    player.playbackRate(2);
    player.play();
  });
}
function pauseVideo(vid) {
  // console.log('pause video');
  // console.log(vid);
  videojs(vid).ready(function() {
    var player = this;
    player.pause();
  });
}
