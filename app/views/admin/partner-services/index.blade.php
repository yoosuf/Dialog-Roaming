@extends('layouts.scaffold')

@section('main')
    <section class="content-header">
        <h1>
            Partner Services
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Partner Services</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">

                    @if(Auth::user()->role_id == 3)
                        <p>{{ link_to_route('partner-services.create', 'Add New' ) }}</p>
                    @else
                        <p>{{ link_to_route('partners.categories.services.create', 'Add New', [$partner->id, $category->id] ) }}</p>
                    @endif

                    @if ($data->count())
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Partner Name</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{{ $item->service_name }}}</td>


                                    <td>
                                    @if(Auth::user()->role_id == 3)
                                        {{ link_to_route('partner-services.edit', 'Edit', array($item->id), array('class' => 'btn btn-info')) }}
                                    @else
                                            {{ link_to_route('partners.categories.services.edit', 'Edit', [$partner->id, $category->id, $item->id], array('class' => 'btn btn-info')) }}
                                    @endif
                                    </td>
                                    <td>
                                        {{ Form::open(array('method' => 'DELETE', 'route' => array('partner-services.destroy', $item->id))) }}
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
                </div>

            </div>
            <!--/.col (left) -->
        </div>
    </section>

@stop
