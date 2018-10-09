@extends('layouts.admin')

@section('content')
	@if (Session::has('message'))
		<div class="alert {{ session('alert-class', 'alert-info') }} alert-dismissible" role="alert">
			{{ session('message') }}
		</div>
	@endif

	<h1>Media</h1>
	<br>

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th><input type="checkbox" onclick="checkAllMedia(this);"></th>
				<th>ID</th>
				<th>File Path</th>
				<th>Created At</th>
				<th>Updated At</th>
				<th class="button_column">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			@if ($photos)
				{!! Form::open(['method' => 'DELETE', 'action' => 'AdminMediaController@deleteChecked', 'id' => 'delete_checked_media']) !!}
					<div class="form-group">
						<a href="javascript:;" class="btn btn-danger" onclick="deleteCheckedMedias();">Delete checked</a>
					</div>
				{!! Form::close() !!}

				@foreach ($photos as $photo)
					<tr>
						<td>
							<input type="checkbox" name="medias[]" class="media_cb" value="{{ $photo->id }}">
						</td>
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

@section('scripts')
	<script>
		function deleteCheckedMedias() {
			if ($("input[name='medias[]']").length == 0)
				return false;

			var checked_medias = [];
			$("input[name='medias[]']").each(function(idx, el) {
				if (el.checked)
					checked_medias.push(el.value);
			});

			var $medias_checked = $("#delete_checked_media input[name='medias_checked']");
			if ($medias_checked.length > 0)
				$medias_checked.val(checked_medias.join(", "));
			else
				$("#delete_checked_media").append("<input type='hidden' name='medias_checked' value='" + checked_medias.join(", ") + "'>");

			$("#delete_checked_media").submit();
		}

		function checkAllMedia(main_cb) {
			var $all_cbs = $("input[name='medias[]']");

			if (main_cb.checked) {
				$all_cbs.each(function(idx, el) {
					el.checked = true;
				});
			}
			else {
				$all_cbs.each(function(idx, el) {
					el.checked = false;
				});
			}
		}
	</script>
@endsection