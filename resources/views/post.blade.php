@extends('layouts.blog-home')

@section('content')
	<div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
			<!-- Blog Post -->

			<!-- Title -->
			<h1>{{ $post->title }}</h1>

			<!-- Author -->
			<p class="lead">
				by {{ $post->user->name }}
			</p>

			<hr>

			<!-- Date/Time -->
			<p><span class="glyphicon glyphicon-time"></span> Posted {{ $post->created_at->diffForHumans() }}</p>

			<hr>

			<!-- Preview Image -->
			@if ($post->photo)
				<img class="img-responsive" src="{{ $post->photo->file_path }}" alt="">
			@else
				<img class="media-object" src="{{ $post->photoPlaceholder() }}" alt="">
			@endif

			<hr>

			<!-- Post Content -->
			<p class="lead">{!! $post->body !!}</p>

			<hr>

			<!-- Blog Comments -->
			@if (Auth::check())
				{{-- @if (Session::has('comment_message'))
					<div class="alert {{ session('alert-class', 'alert-info') }} alert-dismissible" role="alert">
						{{ session('comment_message') }}
					</div>
				@endif --}}

				<!-- Comments Form -->
				<div class="well">
					<h4>Leave a Comment:</h4>

					{!! Form::open(['method' => 'POST', 'action' => 'PostCommentsController@store']) !!}
						{!! Form::hidden('post_id', $post->id) !!}

						<div class='form-group'>
							{!! Form::textarea('body', null, ['class' => 'form-control']) !!}
						</div>
						<div class='form-group'>
							{!! Form::submit('Submit Comment', ['class' => 'btn btn-primary']) !!}
						</div>
					{!! Form::close() !!}

				</div>
				<hr>
			@endif

			<!-- Posted Comments -->
			@if (count($comments) > 0)
				@foreach ($comments as $comment)
					<!-- Comment -->
					<div class="media">
						<a class="pull-left" href="#">
							@if (!empty($comment->photo))
								<img width="64" class="media-object" src="{{ $comment->photo }}" alt="">
							@else
								<img class="media-object" src="http://placehold.it/64x64" alt="">
							@endif
						</a>
						<div class="media-body">
							<h4 class="media-heading">{{ $comment->author }}
								<small>{{ $comment->created_at->diffForHumans() }}</small>
							</h4>
							<p>{{ $comment->body }}</p>
							@if (Auth::check())
								<div style="display: block;" class="clearfix">
									<button class="toggle_reply btn btn-primary pull-right">Reply</button>
								</div>
							@endif

							@foreach ($comment->replies as $reply)
								@if ($reply->is_active)
									<!-- Nested Comment -->
									<div class="media">
										<a class="pull-left" href="#">
											@if (!empty($reply->photo))
												<img width="64" class="media-object" src="{{ $reply->photo }}" alt="">
											@else
												<img class="media-object" src="http://placehold.it/64x64" alt="">
											@endif
										</a>
										<div class="media-body">
											<h4 class="media-heading">{{ $reply->author }}
												<small>{{ $reply->created_at->diffForHumans() }}</small>
											</h4>
											<p>{{ $reply->body }}</p>
										</div>
									</div>
									<!-- End Nested Comment -->
								@endif
							@endforeach

							<br>

							@if (Auth::check())
								<div class="comment_reply_container">
									<div class="comment_reply_form">
										{!! Form::open(['method' => 'POST', 'action' => 'CommentRepliesController@createReply']) !!}
											{!! Form::hidden('comment_id', $comment->id) !!}

											<div class='form-group'>
												{!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 4]) !!}
											</div>
											<div class='form-group'>
												{!! Form::submit('Submit Reply', ['class' => 'btn btn-primary']) !!}
											</div>
										{!! Form::close() !!}
									</div>
								</div>
							@endif
						</div>
					</div>
				@endforeach
			@endif
		</div>
        <!-- Blog Sidebar -->
        @include('includes.front_sidebar')
    </div>
    <!-- /.row -->
    <hr>
@endsection

@section('scripts')
	<script>
		$(".toggle_reply").click(function(){
			$(this).parent().parent().find(".comment_reply_container").children().first().slideToggle("slow");
		});
	</script>
@endsection