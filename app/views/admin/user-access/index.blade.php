@extends('layouts.scaffold')

@section('main')

<h1>User-access</h1>

<p>{{ link_to_route('user-access.create', 'Add new Advertisement') }}</p>

@if ($data->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Type</th>
				<th>Title</th>
				<th>description</th>
				<th>external URI</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			@foreach ($data as $item)
				<tr>
					<td>{{{ $item->type }}}</td>
					<td>{{{ $item->title }}}</td>
					<td>{{{ $item->description }}}</td>
					<td>{{{ $item->external_uri }}}</td>



                    <td>{{ link_to_route('user-access.edit', 'Edit', array($item->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('user-access.destroy', $item->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	No Data Available
@endif

@stop
