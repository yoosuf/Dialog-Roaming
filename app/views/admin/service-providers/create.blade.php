@extends('layouts.scaffold')

@section('main')


    <section class="content-header">
        <h1>
            Service Provider / New
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Service Provider/New</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">


                    {{ Form::open(['route' => 'service-providers.store',  'files' => true ]) }}


                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">


                                <div class="form-group">
                                    {{ Form::label('user_id', 'User:') }}
                                    {{ Form::select('user_id', $service_providers, null, ['class' => 'form-control elwidth2']) }}

                                    @if($errors->has('user_id'))
                                        <p class="text-warning"> {{ $errors->first('user_id') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('sp_code', 'Service Provider code:') }}
                                    {{ Form::text('sp_code', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('sp_code'))
                                        <p class="text-warning"> {{ $errors->first('sp_code') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('sp_name', 'Service Provider Name:') }}
                                    {{ Form::text('sp_name', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('sp_name'))
                                        <p class="text-warning"> {{ $errors->first('sp_name') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('mcc', 'MCC:') }}
                                    {{ Form::text('mcc', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('mcc'))
                                        <p class="text-warning"> {{ $errors->first('mcc') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('mnc', 'MNC:') }}
                                    {{ Form::text('mnc', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('mnc'))
                                        <p class="text-warning"> {{ $errors->first('mnc') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('country_code', 'Country code:') }}
                                    {{ Form::text('country_code', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('country_code'))
                                        <p class="text-warning"> {{ $errors->first('country_code') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('splash_screen_logo', 'Splash screen logo:') }}
                                    {{ Form::file('splash_screen_logo' ) }}
                                    @if($errors->has('splash_screen_logo'))
                                        <p class="text-warning"> {{ $errors->first('splash_screen_logo') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('splash_screen_text', 'Splash screen text:') }}
                                    {{ Form::text('splash_screen_text', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('splash_screen_text'))
                                        <p class="text-warning"> {{ $errors->first('splash_screen_text') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('main_screen_logo', 'Main screen logo:') }}
                                    {{ Form::file('main_screen_logo' ) }}
                                    @if($errors->has('main_screen_logo'))
                                        <p class="text-warning"> {{ $errors->first('main_screen_logo') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('main_screen_text', 'Main screen text:') }}
                                    {{ Form::text('main_screen_text', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('main_screen_text'))
                                        <p class="text-warning"> {{ $errors->first('main_screen_text') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('contact_telephone', 'Contact telephone:') }}
                                    {{ Form::text('contact_telephone', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('contact_telephone'))
                                        <p class="text-warning"> {{ $errors->first('contact_telephone') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('contact_email', 'Email:') }}
                                    {{ Form::text('contact_email', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('contact_email'))
                                        <p class="text-warning"> {{ $errors->first('contact_email') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('website_url', 'Website:') }}
                                    {{ Form::text('website_url', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('website_url'))
                                        <p class="text-warning"> {{ $errors->first('website_url') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('country_id', 'country:') }}

                                    {{ Form::select('country_id', $countries, null,  ['class' => 'form-control elwidth2']) }}

                                    @if($errors->has('country_id'))
                                        <p class="text-warning"> {{ $errors->first('country_id') }}</p>
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


