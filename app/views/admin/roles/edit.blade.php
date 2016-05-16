@extends('layouts.scaffold')

@section('main')



    <section class="content-header">
        <h1>
            Role / Edit
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Role/Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">

                    {{ Form::model($data, array('method' => 'PATCH', 'route' => array('roles.update', $data->id))) }}


                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">


                                <div class="form-group">
                                    {{ Form::label('name', 'Name:') }}
                                    {{ Form::text('name', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('name'))
                                        <p class="text-warning"> {{ $errors->first('name') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('is_active', 'Status:') }}
                                    {{ Form::checkbox('is_active') }}
                                    @if($errors->has('is_active'))
                                        <p class="text-warning"> {{ $errors->first('is_active') }}</p>
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
