@extends('layouts.admin')

@section('content')
	<h1>Edit User</h1>
	<div class="row">
		<div class="col-sm-3">
			@if (isset($user->photo))
				<img src="{{ $user->photo->file_path }}" alt="User photo" class="img-responsive img-rounded">
			@else
				<h2>No photo</h2>
			@endif
		</div>
		<div class="col-sm-9">
			{!! Form::model($user, ['method' => 'PATCH',
									'action' => ['AdminUsersController@update', $user->id],
									'files' => true])
			!!}
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
					{!! Form::radio('is_active', 0, true, ['id' => NULL]) !!} Inactive
					{!! Form::radio('is_active', 1, false, ['id' => NULL]) !!} Active
				</div>
				<div class='form-group'>
					{!! Form::label('password', 'Password:') !!}
					{!! Form::password('password', ['class' => 'form-control']) !!}
				</div>
				<div class='form-group'>
					{!! Form::label('photo_id', 'Image File:') !!}
					{!! Form::file('photo_id', ['class' => 'form-control']) !!}
				</div>
				<div class='form-group '>
					{!! Form::submit('Update User', ['class' => 'btn btn-primary']) !!}
					<a href="javascript:;" onclick="getElementById('delete_user').submit();" class="btn btn-danger">Delete</a>
				</div>
			{!! Form::close() !!}

			{!! Form::open(['method' => 'DELETE',
							'action' => ['AdminUsersController@destroy', $user->id],
							'id' => 'delete_user'])
			!!}
			{!! Form::close() !!}
		</div>
	</div>
	<div class="row">
		@include('errors.form-error')
	</div>
@endsection