@extends('layouts.admin')

@section('content')
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
			</tr>
		</thead>
		<tbody>
			@if ($posts)
				@foreach ($posts as $post)
					<tr>
						<td>{{ $post->id }}</td>
						<td>{{ $post->title }}</td>
						<td>{{ $post->body }}</td>
						<td>{{ $post->user->name }}</td>
						<td>{{ $post->category_id }}</td>
						<td>
							@if ($post->photo_id)
								<img src="{{ $post->photo->file_path }}" height="100">
							@else
								No photo
							@endif
						</td>
						<td>{{ $post->created_at->diffForHumans() }}</td>
						<td>{{ $post->updated_at->diffForHumans() }}</td>
					</tr>
				@endforeach
			@endif
		</tbody>
	</table>
@endsection