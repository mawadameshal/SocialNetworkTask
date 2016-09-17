@extends('layouts.master')

@section('content')
    @include('includes.message-block')
    <section class="row new-post">
        <div class="col-md-4">
            <header><h3>Text Post</h3></header>
            <form action="{{ route('post.create') }}" method="post">
                <div class="form-group">
                    <textarea class="form-control" name="body" id="new-post" rows="5" placeholder="Your Post"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create Post</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
        </div>

        <div class="col-md-4">
            <header><h3>Image Post</h3></header>
            <form  action="{{ route('post.uploads') }}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="text" name="imagename" id="image-name" class="form-control" placeholder="See Something about Image !">
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Image Upload</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
        </div>

        <div class="col-md-4">
            <header><h3>Video Post</h3></header>
            <form action="{{ route('post.uploadv') }}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="text" name="videoname" id="videoname" class="form-control" placeholder="See Something about Video !">
                   <input type="file" name="video" id="video" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Video Upload</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
        </div>
    </section>
    <section class="row posts ">
        <div class="col-md-12 ">
            <header><h3>People Posts !!</h3></header>
            @foreach($posts as $post)
                <article class="post" data-postid="{{ $post->id }}">
                    <p>@if($post->body != "" ) {{ $post->body }} @endif</p>

                    <p>@if($post->image != "" )  <img src = "../uploads/{{$post->image}}" class="img-responsive" width="300px" height="300px"> @endif </p>
                    <p>@if($post->imagename != "" ) {{ $post->imagename }} @endif</p>

                    <p>@if($post->video != "" ) <video width="400" controls>
                            <source src = "../uploadv/{{$post->video}}" type="video/mp4">
                        </video> @endif </p>
                    <p>@if($post->videoname != "" ) {{ $post->videoname }} @endif</p>

                    <div class="info">
                        Posted by {{ $post->user->first_name }} on {{ $post->created_at }}
                    </div>

                    <hr>
                </article>
              @foreach($post->replies as $reply)
                <div class="media">

                    <div class="media-body">
                        <h5 class="media-heading"><a href="#">{{ $reply->user->first_name  }}</a></h5>
                        <p>{{ $reply->body }}</p>
                        <ul class="list-inline">
                            <li>{{ $reply->created_at }}</li>
                        </ul>
                    </div>
                </div>
              @endforeach
                <form role="form" action="{{ route('post.reply' ,['postId' => $post->id]) }}" method="post">
                    <div class="form-group">
                        <textarea name="reply-{{$post->id}}" class="form-control" rows="2" placeholder="Reply to this status"></textarea>

                    </div>
                    <input type="hidden" value="{{ Session::token() }}" name="_token">
                    <input type="submit" value="Reply" class="btn btn-default btn-sm">
                </form>




            @endforeach
        </div>
    </section>



@endsection