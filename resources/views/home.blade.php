@extends('layouts.app')

@section('content')
<div id="home">
    <div class="row justify-content-center">
        <div id="" class="col-md-2">
            <div class="user-component">
                <div class="users-videos"></div>
            </div>

            <div class="upload-component">
                <form action="{{url('uploadVideo')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    Upload Your videos
                    <input type="text" name="title" placeholder="Title">
        
                    <input type="text" name="description" placeholder="Description">
        
                    <input type="file" name="file">
        
                    <input type="submit">
                </form>
            </div>
            
        </div>
        <div class="col-md-10">
            2
        </div>
    </div>
</div>
@endsection
