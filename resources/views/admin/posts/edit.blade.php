@extends('layouts.admin')

@section('content')
	<h1>Edit Post</h1>
	<div class="row">
		<div class="col-sm-3">
			@if (isset($post->photo))
				<img src="{{ $post->photo->file_path }}" alt="Post photo" class="img-responsive img-rounded">
			@else
				<h2>No photo</h2>
			@endif
		</div>
		<div class="col-sm-9">
			{!! Form::model($post, ['method' => 'PATCH', 'action' => ['AdminPostsController@update', $post->id], 'files' => true]) !!}
				<div class='form-group'>
					{!! Form::label('title', 'Title:') !!}
					{!! Form::text('title', null, ['class' => 'form-control']) !!}
				</div>
				<div class='form-group'>
					{!! Form::label('body', 'Body:') !!}
					{!! Form::textarea('body', null, ['class' => 'form-control']) !!}
				</div>
				<div class='form-group'>
					{!! Form::label('category_id', 'Category:') !!}
					{!! Form::select('category_id', ['' => 'Select Category'] + $categories, null, ['class' => 'form-control']) !!}
				</div>
				<div class='form-group'>
					{!! Form::label('photo_id', 'Photo:') !!}
					{!! Form::file('photo_id') !!}
				</div>
				<div class='form-group' style="margin-top: 50px;">
					{!! Form::submit('Update Post', ['class' => 'btn btn-primary']) !!}
					<a href="javascript:;" onclick="getElementById('delete_post').submit();" class="btn btn-danger">Delete</a>
				</div>
			{!! Form::close() !!}

			{!! Form::open(['method' => 'DELETE',
							'action' => ['AdminPostsController@destroy', $post->id],
							'id' => 'delete_post'])
			!!}
			{!! Form::close() !!}
		</div>
	</div>
	<div class="row">
		@include('errors.form-error')
	</div>
@endsection