@extends('layouts.scaffold')

@section('main')


    <section class="content-header">
        <h1>
            Service Provider API
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Service Provider API</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">


                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('service_provider_id', 'Service Provider:') }}
                                    {{ Form::select('service_provider_id', ['' => 'Select a service provider']+$serviceProviders, null, ['class' => 'form-control elwidth2']) }}
                                    @if($errors->has('service_provider_id'))
                                        <p class="text-warning"> {{ $errors->first('service_provider_id') }}</p>
                                    @endif



                                    <div class="form-group">

                                    @if ($data->count())

                                        @foreach ($data as $item)

                                                {{ $item->mobileApi }}

                                        @endforeach
                                    @else
                                        No Data Available
                                    @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>





                </div>

            </div>
            <!--/.col (left) -->
        </div>
    </section>



@stop
