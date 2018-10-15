@extends('layouts.blog-home')

@section('content')
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <!-- Blog Posts -->
            @if (count($posts) > 0)
                @foreach ($posts as $post)
                    <h2>
                        <a href="#">{{ $post->title }}</a>
                    </h2>
                    <p class="lead">
                        by {{ $post->user->name }}
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted {{ $post->created_at->diffForHumans() }}</p>
                    <hr>
                    @if ($post->photo_id)
                        <img height="200" src="{{ $post->photo->file_path }}">
                    @else
                        <img class="img-responsive" src="http://placehold.it/900x300" alt="placeholder">
                    @endif
                    <hr>
                    <p>{!! str_limit($post->body, 150) !!}</p>
                    <a class="btn btn-primary" href="post/{{ $post->slug }}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                @endforeach
            @endif
            <!-- Pagination -->
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3" style="text-align: center;">
                    {{ $posts->render() }}
                </div>
            </div>
        </div>
        <!-- Blog Sidebar -->
        @include('includes.front_sidebar')
    </div>
    <!-- /.row -->
    <hr>
@endsection
