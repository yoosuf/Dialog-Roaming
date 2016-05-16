@extends('layouts.scaffold')

@section('main')


    <section class="content-header">
        <h1>
            Home Menus
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Home Menu/Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">


                    @if(Auth::user()->role_id === 1)
                        <p>{{ link_to_route('home-menus.create', 'Add new') }}</p>

                        @if ($data->count())
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>title</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{{ $item->title }}}</td>
                                        <td>

                                            @if($item->is_active == 1)
                                                Yes
                                            @else
                                                No
                                            @endif

                                        </td>


                                        <td>{{ link_to_route('home-menus.edit', 'Edit', array($item->id), array('class' => 'btn btn-info')) }}</td>
                                        <td>
                                            {{ Form::open(array('method' => 'DELETE', 'route' => array('home-menus.destroy', $item->id))) }}
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

                    @else

                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                        @foreach ($data as $item)

                                    <tr>
                                        <td>{{{ $item->title }}}</td>
                                        <td>

                                            @if($item->is_active == 1)
                                                Yes
                                            @else
                                                No
                                            @endif

                                        </td>


                                        <td>{{ link_to_route('home-menus.edit', 'Edit', array($item->id), array('class' => 'btn btn-info')) }}</td>

                                    </tr>

                        @endforeach

                            </tbody>
                        </table>

                    @endif




                </div>


            </div>
            <!--/.col (left) -->
        </div>
    </section>

@stop
