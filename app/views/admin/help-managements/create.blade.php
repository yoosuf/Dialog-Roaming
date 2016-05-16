@extends('layouts.scaffold')

@section('main')

    <section class="content-header">
        <h1>
            Help Management / New
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Help Management/New</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">




                    {{ Form::open(array('route' => 'help-managements.store')) }}


                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">

                                @if(Auth::user()->role_id === 1)
                                    <div class="form-group">
                                        {{ Form::label('service_provider_id', 'Service Provider:') }}
                                        {{ Form::select('service_provider_id', $serviceProviders , null, ['class' => 'form-control elwidth2'] ) }}
                                        @if($errors->has('service_provider_id'))
                                            <p class="text-warning"> {{ $errors->first('service_provider_id') }}</p>
                                        @endif
                                    </div>
                                @endif


                                <div class="form-group">
                                    {{ Form::label('subject', 'Subject:') }}
                                    {{ Form::text('subject', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('subject'))
                                        <p class="text-warning"> {{ $errors->first('subject') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('description', 'Description:') }}
                                    {{ Form::textarea('description', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('description'))
                                        <p class="text-warning"> {{ $errors->first('description') }}</p>
                                    @endif
                                </div>



                                <div class="form-group">
                                    {{ Form::label('is_active', 'Status:') }}
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


