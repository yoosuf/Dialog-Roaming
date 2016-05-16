@include('layouts.parts.header')
@include('layouts.parts.nav')

@if (Session::has('message'))
	<div class="modal fade" id="alert" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-body">
					<p>{{ Session::get('message') }}</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<script> $('#alert').modal('show');</script>
@endif


@yield('main')

@include('layouts.parts.footer')
