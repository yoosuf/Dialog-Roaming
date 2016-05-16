@extends('layouts.scaffold')

@section('main')



    <section class="content-header">
        <h1>
            Home Menu / Edit
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Home Menu/Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">


                    {{ Form::model($data, ['method' => 'PATCH', 'route' => ['home-menus.update', $data->id], 'files' => true]) }}


                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">


                                <div class="form-group">
                                    {{ Form::label('title', 'Subject:') }}
                                    {{ Form::text('title', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('title'))
                                        <p class="text-warning"> {{ $errors->first('title') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('banner_img', 'Banner image:') }}
                                    <img src="{{ $data->banner_img }}" width="200px"/>
                                    {{ Form::file('banner_img' ) }}
                                    @if($errors->has('banner_img'))
                                        <p class="text-warning"> {{ $errors->first('banner_img') }}</p>
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
                        {{ Form::submit('Update', array('class' => 'btn btn-info')) }}

                    </div>


                    {{ Form::close() }}

                </div>

            </div>
            <!--/.col (left) -->
        </div>
    </section>
@stop
