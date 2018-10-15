@if (Session::has('comment_message'))
	<div class="alert {{ session('alert-class', 'alert-info') }} alert-dismissible" role="alert">
		{{ session('comment_message') }}
	</div>
@endif