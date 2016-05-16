@extends('layouts.scaffold')

@section('main')

	<section class="content-header">
		<h1>

			@if(Auth::user()->role_id == 1)
			Users
			@else
				Partners
			@endif
			<small></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active">@if(Auth::user()->role_id == 1)
					Users
				@else
					Partners
				@endif</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="box box-primary">

					<p>{{ link_to_route('users.create', 'Add new') }}</p>

					@if ($data->count())
						<table class="table table-striped table-bordered">
							<thead>
							<tr>
								<th>Username</th>
								<th>Active</th>
								<th>Role</th>
								<th></th>
							</tr>
							</thead>

							<tbody>
							@foreach ($data as $item)
								<tr>
									<td>{{ $item->username }}</td>
									<td>
										@if($item->is_active == 1)
											Yes
										@else
											No
										@endif
									</td>
									<td>{{ $item->role->name }}</td>

									@if(Auth::user()->role_id == 1)
									<td>{{ link_to_route('users.edit', 'Edit', array($item->id), array('class' => 'btn btn-info')) }}</td>
									@endif


									{{--<td>--}}
										{{--{{ Form::open(array('method' => 'DELETE', 'route' => array('users.destroy', $item->id))) }}--}}
										{{--{{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}--}}
										{{--{{ Form::close() }}--}}
									{{--</td>--}}
								</tr>
							@endforeach
							</tbody>
						</table>
					@else
						No Data Available
					@endif


				</div>

			</div>
			<!--/.col (left) -->
		</div>
	</section>














@stop
