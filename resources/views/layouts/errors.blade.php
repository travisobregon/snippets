@if (count($errors))
	<div class="alert alert-danger" role="alert">
		<strong>Oh snap!</strong> Change a few things up and try submitting again.

		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif