@extends('layouts.admin')

@section('content')
	<h1>Comments section</h1>

	@if (count($comments))
		<table class='table table-bordered'>
			<thead>
				<tr>
					<th>ID</th>
					<th>Post ID</th>
					<th>Active</th>
					<th>Author</th>
					<th>Email</th>
					<th>Body</th>
					<th>Created At</th>
					<th>Updated At</th>
					<th>Photo</th>
					<td>&nbsp;</td>
				</tr>
			</thead>
			<tbody>
				@foreach ($comments as $comment)
					<tr>
						<td>{{ $comment->id }}</td>
						<td><a href="{{ route('home.post', $comment->post_id) }}">View post #{{ $comment->post_id }}</a></td>
						<td>{{ $comment->is_active }}</td>
						<td>{{ $comment->author }}</td>
						<td>{{ $comment->email }}</td>
						<td>{{ $comment->body }}</td>
						<td>{{ $comment->created_at->diffForHumans() }}</td>
						<td>{{ $comment->updated_at->diffForHumans() }}</td>
						<td>
							@if (!empty($comment->photo))
								<img src="{{ $comment->photo }}" height="80" style="display: block; margin: 0 auto;">
							@else
								No photo
							@endif
						</td>
						<td class="button_column">
							{!! Form::open(['method' => 'PATCH', 'action' => ['PostCommentsController@update', $comment->id]]) !!}
								@if ($comment->is_active)
									{!! Form::hidden('is_active', 0) !!}
									{!! Form::submit('Unapprove', ['class' => 'btn btn-xs btn-primary']) !!}
								@else
									{!! Form::hidden('is_active', 1) !!}
									{!! Form::submit('Approve', ['class' => 'btn btn-xs btn-success']) !!}
								@endif
							{!! Form::close() !!}

							{!! Form::open(['method' => 'DELETE', 'action' => ['PostCommentsController@destroy', $comment->id]]) !!}
								{!! Form::submit('Delete', ['class' => 'btn btn-xs btn-danger']) !!}
								<a href="{{ route('admin.comment.replies.show', $comment->id) }}" class="btn btn-xs btn-default">Show replies</a>
							{!! Form::close() !!}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@endif
@endsection