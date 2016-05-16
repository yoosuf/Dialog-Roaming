@extends('layouts.scaffold')

@section('main')

    <section class="content-header">
        <h1>
            Advertisements
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Advertisements</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">


                    <p>{{ link_to_route('advertisements.create', 'Add new') }}</p>

                    @if ($data->count())
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Service Provider</th>
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
                                    <td>{{{ $item->serviceProvider->sp_name }}}</td>
                                    <td>{{{ $item->type }}}</td>
                                    <td>{{{ $item->title }}}</td>
                                    <td>{{{ $item->description }}}</td>
                                    <td>{{{ $item->external_uri }}}</td>


                                    <td>{{ link_to_route('advertisements.edit', 'Edit', array($item->id), array('class' => 'btn btn-info')) }}</td>
                                    <td>
                                        {{ Form::open(array('method' => 'DELETE', 'route' => array('advertisements.destroy', $item->id))) }}
                                        {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $data->links() }}
                    @else
                        No Data Available
                    @endif


                </div>
            </div>
        </div>
    </section>

@stop
