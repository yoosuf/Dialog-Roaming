@extends('layouts.scaffold')

@section('main')

    <section class="content-header">
        <h1>
            App Menus
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">App Menus</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    @if(Auth::user()->role_id === 1)
                        <p>{{ link_to_route('app-menus.create', 'Add new') }}</p>

                        @if ($data->count())
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Menu Name</th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{{ $item->menu_name }}}</td>


                                        <td>{{ link_to_route('app-menus.edit', 'Edit', array($item->id), array('class' => 'btn btn-info')) }}</td>
                                        {{--<td>--}}
                                            {{--{{ Form::open(array('method' => 'DELETE', 'route' => array('app-menus.destroy', $item->id))) }}--}}
                                            {{--{{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}--}}
                                            {{--{{ Form::close() }}--}}
                                        {{--</td>--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            {{ $data->links() }}
                        @else
                            No Data Available
                        @endif



                    @else

                        {{ Form::open(['url' => 'update-site-menus']) }}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">

                                    @if ($data->count())
                                    <table class="table table-striped table-bordered">

                                        <tbody>


                                        @foreach ($data as $item)
                                            <tr>

                                                <?php

                                                if(!empty($item->is_active))
                                                    $checkbox = true;
                                                else
                                                    $checkbox = false;
                                                ?>

                                                <td>{{ Form::checkbox('is_active['. $item->id.']', null, $checkbox ) }}</td>
                                                <td>{{ $item->menu_name }}</td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                    @else
                                        No Data Available
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="box-footer">
                            {{ Form::submit('Submit', array('class' => 'btn btn-info')) }}

                        </div>
                        {{ Form::close() }}

                    @endif


                </div>
            </div>
        </div>
    </section>

@stop
