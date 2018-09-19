@extends('layouts.admin')

@section('content')
	<h1>Edit Category</h1>

	<div class="row">
		<div class="col-sm-12">
			{!! Form::model($category, ['method' => 'PATCH', 'action' => ['AdminCategoriesController@update', $category->id]]) !!}
				<div class='form-group'>
					{!! Form::label('name', 'Name:') !!}
					{!! Form::text('name', null, ['class' => 'form-control']) !!}
				</div>
				<div class='form-group'>
					{!! Form::submit('Update Category', ['class' => 'btn btn-primary']) !!}
					<a href="javascript:;" onclick="getElementById('delete_category').submit();" class="btn btn-danger">Delete</a>
				</div>
			{!! Form::close() !!}

			{!! Form::open(['method' => 'DELETE',
							'action' => ['AdminCategoriesController@destroy', $category->id],
							'id' => 'delete_category'])
			!!}
			{!! Form::close() !!}
		</div>
	</div>
	<div class="row">
		@include('errors.form-error')
	</div>
@endsection