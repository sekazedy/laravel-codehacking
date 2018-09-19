@extends('layouts.admin')

@section('content')
	@if (Session::has('message'))
		<div class="alert {{ session('alert-class', 'alert-info') }} alert-dismissible" role="alert">
			{{ session('message') }}
		</div>
	@endif

	<h1>Media</h1>

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>ID</th>
				<th>File Path</th>
				<th>Created At</th>
				<th>Updated At</th>
				<th class="button_column">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			@if ($photos)
				@foreach ($photos as $photo)
					<tr>
						<td>{{ $photo->id }}</td>
						<td><img src="{{ $photo->file_path }}" height="200"></td>
						<td>{{ $photo->created_at->diffForHumans() }}</td>
						<td>{{ $photo->updated_at->diffForHumans() }}</td>
						<td class="button_column">
							{!! Form::open(['method' => 'DELETE', 'action' => ['AdminMediaController@destroy', $photo->id]]) !!}
								{!! Form::submit('Delete', ['class' => 'btn btn-xs btn-danger']) !!}
							{!! Form::close() !!}
						</td>
					</tr>
				@endforeach
			@endif
		</tbody>
	</table>
@endsection