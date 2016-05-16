@extends('layouts.scaffold')

@section('main')


    <section class="content-header">
        <h1>
            App Menus / Edit
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">App Menus/Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">


                    {{ Form::model($data, ['method' => 'PATCH', 'route' => ['app-menus.update', $data->id], 'files' => true]) }}

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">



                                <div class="form-group">
                                    {{ Form::label('menu_name', 'Menu Name:') }}
                                    {{ Form::text('menu_name', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('menu_name'))
                                        <p class="text-warning"> {{ $errors->first('menu_name') }}</p>
                                    @endif
                                </div>





                            </div>
                        </div>
                    </div>


                    <div class="box-footer">
                        {{ Form::submit('Submit', array('class' => 'btn btn-info')) }}

                    </div>
                    {{ Form::close() }}


                </div>

            </div>
            <!--/.col (left) -->
        </div>
    </section>

@stop
