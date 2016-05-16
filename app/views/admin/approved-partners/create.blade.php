@extends('layouts.scaffold')

@section('main')

    <section class="content-header">
        <h1>
            Approved Partner / New
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Approved Partner/New</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">


                    {{ Form::open(array('route' => 'approved-partners.store')) }}

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">




                                <div class="form-group">
                                    {{ Form::label('service_provider_id', 'Service Provider:') }}
                                    {{ Form::select('service_provider_id', $providers, null, ['class' => 'form-control elwidth2']) }}
                                    @if($errors->has('service_provider_id'))
                                        <p class="text-warning"> {{ $errors->first('service_provider_id') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    {{ Form::label('partner_id', 'Partner:') }}
                                    {{ Form::select('partner_id', $partners, null, ['class' => 'form-control elwidth2']) }}
                                    @if($errors->has('partner_id'))
                                        <p class="text-warning"> {{ $errors->first('partner_id') }}</p>
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


