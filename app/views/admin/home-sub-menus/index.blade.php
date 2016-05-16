@extends('layouts.scaffold')

@section('main')


    <section class="content-header">
        <h1>
            Home Sub Menus
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Home Sub Menus</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">


                    <p>{{ link_to_route('home-sub-menus.create', 'Add new') }}</p>

                    @if ($data->count())
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Home menu</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{{ $item->title }}}</td>
                                    <td>{{{ $item->menu->title }}}</td>
                                    <td>

                                        @if($item->is_active == 1)
                                            Yes
                                        @else
                                            No
                                        @endif

                                    </td>


                                    <td>{{ link_to_route('home-sub-menus.edit', 'Edit', array($item->id), array('class' => 'btn btn-info')) }}</td>
                                    <td>
                                        {{ Form::open(array('method' => 'DELETE', 'route' => array('home-sub-menus.destroy', $item->id))) }}
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
