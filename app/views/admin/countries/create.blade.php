@extends('layouts.scaffold')

@section('main')

    <section class="content-header">
        <h1>
            Country / New
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Country/New</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">

                    {{ Form::open(array('route' => 'countries.store')) }}


                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">


                                <div class="form-group">
                                    {{ Form::label('country_code', 'Country code:') }}
                                    {{ Form::text('country_code', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('country_code'))
                                        <p class="text-warning"> {{ $errors->first('country_code') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('country_name', 'Country name:') }}
                                    {{ Form::text('country_name', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('country_name'))
                                        <p class="text-warning"> {{ $errors->first('country_name') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('country_currency', 'Country currency:') }}
                                    {{ Form::text('country_currency', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('country_currency'))
                                        <p class="text-warning"> {{ $errors->first('country_currency') }}</p>
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


