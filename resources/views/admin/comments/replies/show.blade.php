@extends('layouts.admin')

@section('content')
	<h1>Replies section</h1>

	@if (count($replies))
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
				@foreach ($replies as $reply)
					<tr>
						<td>{{ $reply->id }}</td>
						<td><a href="{{ route('home.post', $reply->comment->post_id) }}">View post #{{ $reply->comment->post_id }}</a></td>
						<td>{{ $reply->is_active }}</td>
						<td>{{ $reply->author }}</td>
						<td>{{ $reply->email }}</td>
						<td>{{ $reply->body }}</td>
						<td>{{ $reply->created_at->diffForHumans() }}</td>
						<td>{{ $reply->updated_at->diffForHumans() }}</td>
						<td>
							@if (!empty($reply->photo))
								<img src="{{ $reply->photo }}" height="80" style="display: block; margin: 0 auto;">
							@else
								No photo
							@endif
						</td>
						<td class="button_column">
							{!! Form::open(['method' => 'PATCH', 'action' => ['CommentRepliesController@update', $reply->id]]) !!}
								@if ($reply->is_active)
									{!! Form::hidden('is_active', 0) !!}
									{!! Form::submit('Unapprove', ['class' => 'btn btn-primary']) !!}
								@else
									{!! Form::hidden('is_active', 1) !!}
									{!! Form::submit('Approve', ['class' => 'btn btn-success']) !!}
								@endif
							{!! Form::close() !!}

							{!! Form::open(['method' => 'DELETE', 'action' => ['CommentRepliesController@destroy', $reply->id]]) !!}
								{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
							{!! Form::close() !!}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@endif
@endsection