@extends('layouts.scaffold')

@section('main')



    <section class="content-header">
        <h1>
            Service Category / New
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Service Category/New</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">


                    @if(Auth::user()->role_id == 3)

                    {{ Form::open(['route' => 'service-categories.store', 'files' => true]) }}

                    @else
                        {{ Form::open(['route' => ['partners.categories.store', $partner->id], 'files' => true]) }}
                    @endif



                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">


                                @if(Auth::user()->role_id === 1)

                                    <div class="form-group">
                                        {{ Form::label('partner_id', 'Partner:') }}
                                        {{ Form::select('partner_id', $partners, null, ['class' => 'form-control']) }}
                                        @if($errors->has('partner_id'))
                                            <p class="text-warning"> {{ $errors->first('partner_id') }}</p>
                                        @endif
                                    </div>
                                @endif

                                <div class="form-group">
                                    {{ Form::label('service_name', 'Service Category Title:') }}
                                    {{ Form::text('service_name', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('service_name'))
                                        <p class="text-warning"> {{ $errors->first('service_name') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('banner_img', 'Banner Image (Image size 1080 x 370):') }}
                                    {{ Form::file('banner_img') }}
                                    @if($errors->has('banner_img'))
                                        <p class="text-warning"> {{ $errors->first('banner_img') }}</p>
                                    @endif
                                </div>

                                    <div class="form-group">
                                        {{ Form::label('menu_type', 'Menu type:') }}

                                        {{ Form::select('menu_type', ['' => 'Select One']+['explore' => 'Explore', 'deals' => 'Deals', 'dine' => 'Dine', 'stay' => 'Stay', 'transport' => 'Transport', 'flights' => 'Flights'], null,  ['class' => 'form-control']) }}

                                        @if($errors->has('menu_type'))
                                            <p class="text-warning"> {{ $errors->first('menu_type') }}</p>
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


