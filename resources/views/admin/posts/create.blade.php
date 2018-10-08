@extends('layouts.admin')

@section('content')
	@include('includes.tinyeditor')

	<h1>Create Post</h1>

	{!! Form::open(['method' => 'POST', 'action' => 'AdminPostsController@store', 'files' => true]) !!}
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
			{!! Form::select('category_id', [0 => 'Select Category'] + $categories, null, ['class' => 'form-control']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('photo_id', 'Photo:') !!}
			{!! Form::file('photo_id') !!}
		</div>
		<div class='form-group' style="margin-top: 50px;">
			{!! Form::submit('Create Post', ['class' => 'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}

	@include('errors.form-error')
@endsection