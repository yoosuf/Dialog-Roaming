@extends('layouts.scaffold')

@section('main')




    <section class="content-header">
        <h1>
            Service Provider Profile
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Service Provider Profile</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">


                    {{ Form::model($data, ['method' => 'PATCH', 'route' => ['profile'], 'files' => true]) }}


                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">


                                @if(Auth::user()->role_id === 1)

                                    <div class="form-group">
                                        {{ Form::label('sp_name', 'Service Provider Name:') }}
                                        {{ Form::text('sp_name', null, ['class' => 'form-control'] ) }}
                                        @if($errors->has('sp_name'))
                                            <p class="text-warning"> {{ $errors->first('sp_name') }}</p>
                                        @endif
                                    </div>
                                @else




                                    <div class="form-group">
                                        {{ Form::label('sp_code', 'Service Provider code:') }}
                                        {{ Form::text('sp_code', null, ['class' => 'form-control'] ) }}
                                        @if($errors->has('sp_code'))
                                            <p class="text-warning"> {{ $errors->first('sp_code') }}</p>
                                        @endif
                                    </div>




                                    <div class="form-group">
                                        {{ Form::label('sp_name', 'Service Provider Name:') }}
                                        {{ Form::text('sp_name', null, ['class' => 'form-control'] ) }}
                                        @if($errors->has('sp_name'))
                                            <p class="text-warning"> {{ $errors->first('sp_name') }}</p>
                                        @endif
                                    </div>






                                    <div class="form-group">
                                        {{ Form::label('mcc', 'MCC:') }}
                                        {{ Form::text('mcc', null, ['class' => 'form-control'] ) }}
                                        @if($errors->has('mcc'))
                                            <p class="text-warning"> {{ $errors->first('mcc') }}</p>
                                        @endif
                                    </div>





                                    <div class="form-group">
                                        {{ Form::label('mnc', 'MNC:') }}
                                        {{ Form::text('mnc', null, ['class' => 'form-control'] ) }}
                                        @if($errors->has('mnc'))
                                            <p class="text-warning"> {{ $errors->first('mnc') }}</p>
                                        @endif
                                    </div>




                                    {{--<div class="form-group">--}}
                                        {{--{{ Form::label('country_code', 'Country code:') }}--}}
                                        {{--{{ Form::text('country_code', null, ['class' => 'form-control'] ) }}--}}
                                        {{--@if($errors->has('country_code'))--}}
                                            {{--<p class="text-warning"> {{ $errors->first('country_code') }}</p>--}}
                                        {{--@endif--}}
                                    {{--</div>--}}







                                    <div class="form-group">
                                        {{ Form::label('splash_screen_logo', 'Splash screen logo:') }}
                                        <img src="{{ $data->splash_screen_logo }}" width="200px"/>
                                        {{ Form::file('splash_screen_logo' ) }}
                                        @if($errors->has('splash_screen_logo'))
                                            <p class="text-warning"> {{ $errors->first('splash_screen_logo') }}</p>
                                        @endif
                                    </div>




                                    <div class="form-group">
                                        {{ Form::label('splash_screen_text', 'Splash screen text:') }}
                                        {{ Form::text('splash_screen_text', null, ['class' => 'form-control'] ) }}
                                        @if($errors->has('splash_screen_text'))
                                            <p class="text-warning"> {{ $errors->first('splash_screen_text') }}</p>
                                        @endif
                                    </div>





                                    <div class="form-group">
                                        {{ Form::label('main_screen_logo', 'Main screen logo:') }}
                                        <img src="{{ $data->main_screen_logo }}" width="200px"/>
                                        {{ Form::file('main_screen_logo' ) }}
                                        @if($errors->has('main_screen_logo'))
                                            <p class="text-warning"> {{ $errors->first('main_screen_logo') }}</p>
                                        @endif
                                    </div>




                                    <div class="form-group">
                                        {{ Form::label('main_screen_text', 'Main screen text:') }}
                                        {{ Form::text('main_screen_text', null, ['class' => 'form-control'] ) }}
                                        @if($errors->has('main_screen_text'))
                                            <p class="text-warning"> {{ $errors->first('main_screen_text') }}</p>
                                        @endif
                                    </div>




                                    <div class="form-group">
                                        {{ Form::label('contact_telephone', 'Contact telephone:') }}
                                        {{ Form::text('contact_telephone', null, ['class' => 'form-control'] ) }}
                                        @if($errors->has('contact_telephone'))
                                            <p class="text-warning"> {{ $errors->first('contact_telephone') }}</p>
                                        @endif
                                    </div>




                                    <div class="form-group">
                                        {{ Form::label('contact_email', 'Email:') }}
                                        {{ Form::text('contact_email', null, ['class' => 'form-control'] ) }}
                                        @if($errors->has('contact_email'))
                                            <p class="text-warning"> {{ $errors->first('contact_email') }}</p>
                                        @endif
                                    </div>




                                    <div class="form-group">
                                        {{ Form::label('website_url', 'Website:') }}
                                        {{ Form::text('website_url', null, ['class' => 'form-control'] ) }}
                                        @if($errors->has('website_url'))
                                            <p class="text-warning"> {{ $errors->first('website_url') }}</p>
                                        @endif
                                    </div>



                                    <div class="form-group">
                                        {{ Form::label('country_id', 'country:') }}

                                        {{ Form::select('country_id', $countries, null,  ['class' => 'form-control']) }}

                                        @if($errors->has('country_id'))
                                            <p class="text-warning"> {{ $errors->first('country_id') }}</p>
                                        @endif
                                    </div>




                                    <div class="form-group">
                                        {{ Form::label('about_description', 'About Text:') }}
                                        {{ Form::textarea('about_description', null, ['class' => 'form-control'] ) }}
                                        @if($errors->has('about_description'))
                                            <p class="text-warning"> {{ $errors->first('about_description') }}</p>
                                        @endif
                                    </div>





                                    <div class="form-group">
                                        {{ Form::label('about_banner_img', 'About screen  Banner:') }}
                                        <img src="{{ $data->about_banner_img }}" width="200px"/>
                                        {{ Form::file('about_banner_img' ) }}
                                        @if($errors->has('about_banner_img'))
                                            <p class="text-warning"> {{ $errors->first('about_banner_img') }}</p>
                                        @endif
                                    </div>

                                @endif


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
