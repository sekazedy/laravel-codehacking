@extends('layouts.admin')

@section('content')
	<h1>Users</h1>

	<h2>Bordered Table</h2>
	<p>The .table-bordered class adds borders to a table:</p>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Role</th>
				<th>Email</th>
				<th>Created</th>
				<th>Updated</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			@if ($users)
				@foreach ($users as $user)
					<tr>
						<td>{{$user->id}}</td>
						<td>{{$user->name}}</td>
						<td>{{$user->role->name}}</td>
						<td>{{$user->email}}</td>
						<td>{{$user->created_at->format('jS \o\f F Y, H:i:s')}}</td>
						<td>{{$user->updated_at->format('jS \o\f F Y, H:i:s')}}</td>
						<td>{{$user->is_active ? "Active" : "Inactive"}}</td>
					</tr>
				@endforeach
			@endif
		</tbody>
	</table>
@endsection