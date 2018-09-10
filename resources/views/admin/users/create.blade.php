@extends('layouts.admin')

@section('content')
	<h1>Create users</h1>

	{!! Form::open(['method' => 'POST', 'action' => 'AdminUsersController@store', 'files' => true]) !!}
		<div class='form-group'>
			{!! Form::label('name', 'Name:') !!}
			{!! Form::text('name', null, ['class' => 'form-control']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('email', 'Email:') !!}
			{!! Form::email('email', null, ['class' => 'form-control']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('role_id', 'Role:') !!}
			{!! Form::select('role_id', [0 => 'Select Role'] + $roles, null, ['class' => 'form-control']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('is_active', 'Status:') !!}
			{!! Form::radio('is_active', 0, true) !!} Inactive
			{!! Form::radio('is_active', 1) !!} Active
		</div>
		<div class='form-group'>
			{!! Form::label('password', 'Password:') !!}
			{!! Form::password('password', ['class' => 'form-control']) !!}
		</div>
		<div class='form-group'>
			{!! Form::label('file', 'File:') !!}
			{!! Form::file('file', ['class' => 'form-control']) !!}
		</div>
		<div class='form-group'>
			{!! Form::submit('Create User', ['class' => 'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}

	@include('errors.form-error')
@endsection