@extends('layouts.scaffold')

@section('main')


    <section class="content-header">
        <h1>
            Service Categories
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Service Categories</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">


                    @if(Auth::user()->role_id == 3)
                        <p>{{ link_to_route('service-categories.create', 'Add New') }}</p>

                    @else
                        <p>{{ link_to_route('partners.categories.create', 'Add New', $partnerId) }}</p>

                    @endif

                    @if ($data->count())
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Category Title</th>
                                <th>Location to Display</th>
                                <th>Display Category</th>
                                @if(Auth::user()->role_id == 2)
                                <th></th>
                                @endif
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{{ $item->service_name }}}</td>
                                    <td>
                                        {{{ $item->country->country_name }}}


                                    </td>
                                    <td>{{{ $item->menu_type }}}</td>




                                    @if(Auth::user()->role_id == 2)
                                    <td>
                                        <p>{{ link_to_route('partners.categories.services.index', 'Manage Services', array($partnerId, $item->id)) }}</p>
                                    </td>
                                    @endif
                                    <td>

                                        @if(Auth::user()->role_id == 3)
                                            {{ link_to_route('service-categories.edit', 'Edit', array($item->id), array('class' => 'btn btn-info')) }}
                                        @else

                                            {{ link_to_route('partners.categories.edit', 'Edit', array($partnerId, $item->id), array('class' => 'btn btn-info')) }}
                                        @endif

                                    </td>



                                    <td>

                                        @if(Auth::user()->role_id == 3)
                                        {{ Form::open(array('method' => 'DELETE', 'route' => array('service-categories.destroy', $item->id))) }}
                                        {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                                        {{ Form::close() }}
                                        @else
                                            {{ Form::open(array('method' => 'DELETE', 'route' => array('partners.categories.destroy', $partnerId, $item->id))) }}
                                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                                            {{ Form::close() }}


                                        @endif
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
