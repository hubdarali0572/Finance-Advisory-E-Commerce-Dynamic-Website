@if($errors->any())
@foreach($errors->all() as $error)
<div class="alert alert-danger alert-dismissible fade show" role="alert">
	<strong>Error!</strong> {{ $error }}
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endforeach
@endif

@if(Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
	<strong>Success!</strong> {{ Session::get('success') }}
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(Session::has('danger'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
	<strong>Success!</strong> {{ Session::get('danger') }}
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(Session::has('error'))
@php $errorsFromSession = Session::get('error'); @endphp

@if(is_array($errorsFromSession))
@foreach($errorsFromSession as $message)
<div class="alert alert-danger alert-dismissible fade show" role="alert">
	<strong>Error!</strong> {{ $message }}
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endforeach
@else
<div class="alert alert-danger alert-dismissible fade show" role="alert">
	<strong>Error!</strong> {{ $errorsFromSession }}
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@endif
<script>
	$(document).ready(function() {
		let fadeOutTimeout, removeTimeout;
		let alertEl = $('.alert');

		function startTimers() {
			fadeOutTimeout = setTimeout(function() {
				alertEl.fadeOut('slow');
			}, 3000);

			removeTimeout = setTimeout(function() {
				alertEl.remove();
			}, 4000);
		}

		function clearTimers() {
			clearTimeout(fadeOutTimeout);
			clearTimeout(removeTimeout);
		}

		// Start timers initially
		startTimers();

		alertEl.on('mouseenter', function() {
			clearTimers();
		});

		alertEl.on('mouseleave', function() {
			startTimers();
		});
	});
</script>