@extends('layouts.scaffold')

@section('main')


	<section class="content-header">
		<h1>
			Roles
			<small></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active">Roles</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="box box-primary">




<p>{{ link_to_route('roles.create', 'Add new') }}</p>

@if ($data->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Role</th>
				<th>Active</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			@foreach ($data as $item)
				<tr>
					<td>{{ $item->name }}</td>
					<td>
						@if($item->is_active == 1)
							Yes
						@else
							No
						@endif

					</td>
                    <td>{{ link_to_route('roles.edit', 'Edit', array($item->id), array('class' => 'btn btn-info')) }}</td>
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
