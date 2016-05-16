@extends('layouts.scaffold')

@section('main')



    <section class="content-header">
        <h1>
            Home Sub Menu / Edit
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Home Sub Menu/New</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">


                    {{ Form::model($data, ['method' => 'PATCH', 'route' => ['home-sub-menus.update', $data->id],  'files' => true]) }}

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">



                                <div class="form-group">
                                    {{ Form::label('home_menu_id', 'Home Menu:') }}
                                    {{ Form::select('home_menu_id', $homeMenu , null, ['class' => 'form-control']) }}
                                    @if($errors->has('home_menu_id'))
                                        <p class="text-warning"> {{ $errors->first('home_menu_id') }}</p>
                                    @endif
                                </div>



                                <div class="form-group">
                                    {{ Form::label('title', 'Title:') }}
                                    {{ Form::text('title', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('title'))
                                        <p class="text-warning"> {{ $errors->first('title') }}</p>
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
                                    {{ Form::label('banner_img', 'Banner image:') }}
                                    <img src="{{ $data->banner_img }}" width="200px"/>


                                    {{ Form::file('banner_img' ) }}
                                    @if($errors->has('banner_img'))
                                        <p class="text-warning"> {{ $errors->first('banner_img') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    {{ Form::label('external_url', 'External url:') }}
                                    {{ Form::text('external_url', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('external_url'))
                                        <p class="text-warning"> {{ $errors->first('external_url') }}</p>
                                    @endif
                                </div>



                                <div class="form-group">
                                    {{ Form::label('option', 'Option:') }}
                                    {{ Form::text('option', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('option'))
                                        <p class="text-warning"> {{ $errors->first('option') }}</p>
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
