@extends('layouts.scaffold')

@section('main')




    <section class="content-header">
        <h1>
            Roaming Tip / New
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Roaming Tip/New</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">


                    {{ Form::open(['route' => 'roaming-tips.store', 'files' => true]) }}


                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">


                                <div class="form-group">
                                    {{ Form::label('title', 'Title:') }}
                                    {{ Form::text('title', null, ['class' => 'form-control elwidth2']) }}

                                    @if($errors->has('title'))
                                        <p class="text-warning"> {{ $errors->first('title') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('description', 'Description:') }}
                                    {{ Form::textarea('description', null, ['class' => 'form-control elwidth2']) }}

                                    @if($errors->has('description'))
                                        <p class="text-warning"> {{ $errors->first('description') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('banner_img', 'Banner Image:') }}
                                    {{ Form::file('banner_img') }}
                                    @if($errors->has('banner_img'))
                                        <p class="text-warning"> {{ $errors->first('banner_img') }}</p>
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


