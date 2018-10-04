@extends('layouts.admin')

@section('content')
	@if (Session::has('message'))
		<div class="alert {{ session('alert-class', 'alert-info') }} alert-dismissible" role="alert">
			{{ session('message') }}
		</div>
	@endif

	<h1>Posts</h1>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>Id</th>
				<th>Title</th>
				<th>Body</th>
				<th>User</th>
				<th>Category</th>
				<th>Photo</th>
				<th>Created At</th>
				<th>Updated At</th>
				<th class="button_column">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			@if ($posts)
				@foreach ($posts as $post)
					<tr>
						<td>{{ $post->id }}</td>
						<td><a href="{{ route('home.post', $post->slug) }}">{{ $post->title }}</a></td>
						<td>{{ str_limit($post->body, 20) }}</td>
						<td>{{ $post->user->name }}</td>
						<td>{{ $post->category ? $post->category->name : "No category" }}</td>
						<td>
							@if ($post->photo_id)
								<img src="{{ $post->photo->file_path }}" style="max-width: 100px; max-height: 100px;">
							@else
								No photo
							@endif
						</td>
						<td>{{ $post->created_at->diffForHumans() }}</td>
						<td>{{ $post->updated_at->diffForHumans() }}</td>
						<td class="button_column">
							{!! Form::open(['method' => 'DELETE', 'action' => ['AdminPostsController@destroy', $post->id]]) !!}
								<a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-xs btn-warning">Edit</a>
								{!! Form::submit('Delete', ['class' => 'btn btn-xs btn-danger']) !!}
								<a href="{{ route('admin.comments.show', $post->id) }}" class="btn btn-xs btn-default">Show comments</a>
							{!! Form::close() !!}
						</td>
					</tr>
				@endforeach
			@endif
		</tbody>
	</table>

	<div class="row">
		<div class="col-sm-6 col-sm-offset-3" style="text-align: center;">
			{{ $posts->render() }}
		</div>
	</div>
@endsection