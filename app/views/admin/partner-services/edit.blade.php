@extends('layouts.scaffold')

@section('main')

    <section class="content-header">
        <h1>
            Partner Service / Edit
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Partner Service/Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">


                    @if(Auth::user()->role_id == 3)

                    {{ Form::model($data, ['method' => 'PATCH', 'route' => ['partner-services.update', $data->id], 'files' => true]) }}
                    @else
                        {{ Form::model($data, ['method' => 'PATCH', 'route' => ['partners.categories.services.update', $partner->id, $category->id, $data->id], 'files' => true]) }}

                    @endif


                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    {{ Form::label('partner_service_category_id', 'Partner Service Category:') }}
                                    {{ Form::select('partner_service_category_id', $partnerServiceCategories, null, ['class' => 'form-control']) }}
                                    @if($errors->has('partner_service_category_id'))
                                        <p class="text-warning"> {{ $errors->first('partner_service_category_id') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('service_name', 'Service Name:') }}
                                    {{ Form::text('service_name', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('service_name'))
                                        <p class="text-warning"> {{ $errors->first('service_name') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('banner_img', 'Banner Image (Image size 1080 x 490 px):') }}

                                    <img src="{{ $data->banner_img }}" width="200px"/>
                                    {{ Form::file('banner_img') }}
                                    @if($errors->has('banner_img'))
                                        <p class="text-warning"> {{ $errors->first('banner_img') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('description', 'Description:') }}
                                    {{ Form::text('description', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('description'))
                                        <p class="text-warning"> {{ $errors->first('description') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('website_url', 'Website URL:') }}
                                    {{ Form::text('website_url', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('website_url'))
                                        <p class="text-warning"> {{ $errors->first('website_url') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('contact_number', 'Contact Number:') }}
                                    {{ Form::text('contact_number', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('contact_number'))
                                        <p class="text-warning"> {{ $errors->first('contact_number') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('email', 'Email:') }}
                                    {{ Form::text('email', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('email'))
                                        <p class="text-warning"> {{ $errors->first('email') }}</p>
                                    @endif
                                </div>


                            </div>
                        </div>
                    </div>


                    <div class="box-footer">
                        {{ Form::submit('Update', array('class' => 'btn btn-info')) }}

                    </div>


                    {{ Form::close() }}

                </div>

            </div>
            <!--/.col (left) -->
        </div>
    </section>
@stop
