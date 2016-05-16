@extends('layouts.scaffold')

@section('main')
    <section class="content-header">
        <h1>
            Mobile API / Edit
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Mobile API/Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">

                    {{ Form::model($data, array('method' => 'PATCH', 'route' => array('mobile-apis.update', $data->id))) }}

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    {{ Form::label('api_name', 'API name:') }}
                                    {{ Form::text('api_name', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('api_name'))
                                        <p class="text-warning"> {{ $errors->first('api_name') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('api_version', 'App version:') }}
                                    {{ Form::text('api_version', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('api_version'))
                                        <p class="text-warning"> {{ $errors->first('api_version') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    {{ Form::label('is_active', 'Active:') }}
                                    {{ Form::checkbox('is_active') }}
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
