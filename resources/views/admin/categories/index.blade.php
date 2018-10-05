@extends('layouts.admin')

@section('content')
	@if (Session::has('message'))
		<div class="alert {{ session('alert-class', 'alert-info') }} alert-dismissible" role="alert">
			{{ session('message') }}
		</div>
	@endif

	@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	<h1>Categories</h1>

	<div class="row">
		<div class="col-sm-3">
			{!! Form::open(['method' => 'POST', 'action' => 'AdminCategoriesController@store']) !!}
				<div class='form-group'>
					{!! Form::label('name', 'Name:') !!}
					{!! Form::text('name', null, ['class' => 'form-control']) !!}
				</div>
				<div class='form-group'>
					{!! Form::submit('Create Category', ['class' => 'btn btn-primary']) !!}
				</div>
			{!! Form::close() !!}
		</div>
		<div class="col-sm-8 col-sm-offset-1">
			<table class='table table-bordered'>
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Created At</th>
						<th>Updated At</th>
						<th class="button_column">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					@if($categories)
						@foreach ($categories as $category)
							<tr>
								<td>{{ $category->id }}</td>
								<td>{{ $category->name }}</td>
								<td>{{ $category->created_at->diffForHumans() }}</td>
								<td>{{ $category->updated_at->diffForHumans() }}</td>
								<td class="button_column">
									{!! Form::open(['method' => 'DELETE', 'action' => ['AdminCategoriesController@destroy', $category->id]]) !!}
										<a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-xs btn-warning">Edit</a>
										{!! Form::submit('Delete', ['class' => 'btn btn-xs btn-danger']) !!}
									{!! Form::close() !!}
								</td>
							</tr>
						@endforeach
					@endif
				</tbody>
			</table>
		</div>
	</div>
@endsection