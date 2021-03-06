@extends('layouts.scaffold')

@section('main')



    <section class="content-header">
        <h1>
            Service Provider API / Edit
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Service Provider API/Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">

                    {{ Form::model($data, array('method' => 'PATCH', 'route' => array('service-provider-api.update', $data->id))) }}


                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">


                                <div class="form-group">
                                    {{ Form::label('service_provider_id', 'Service Provider:') }}
                                    {{ Form::select('service_provider_id', $providers, null, ['class' => 'form-control']) }}
                                    @if($errors->has('service_provider_id'))
                                        <p class="text-warning"> {{ $errors->first('service_provider_id') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    {{ Form::label('mobile_api_id', 'Mobile API:') }}
                                    {{ Form::select('mobile_api_id', $partners, null, ['class' => 'form-control']) }}
                                    @if($errors->has('mobile_api_id'))
                                        <p class="text-warning"> {{ $errors->first('mobile_api_id') }}</p>
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
