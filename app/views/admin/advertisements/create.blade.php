@extends('layouts.scaffold')

@section('main')



    <section class="content-header">
        <h1>
            Advertisement / New
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Advertisement/New</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">


                    {{ Form::open(['route' => 'advertisements.store', 'files' => true]) }}

                    @if(Auth::user()->role_id === 1)
                        {{ Form::hidden('type', 'GEN'); }}
                    @endif

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">

                                @if(Auth::user()->role_id === 1)



                                    <div class="form-group">
                                        {{ Form::label('service_provider_id', 'Service Provider:') }}
                                        {{ Form::select('service_provider_id', $serviceProviders, null, ['class' => 'form-control']) }}
                                        @if($errors->has('service_provider_id'))
                                            <p class="text-warning"> {{ $errors->first('service_provider_id') }}</p>
                                        @endif
                                    </div>
                                @endif





                                    @if(Auth::user()->role_id != 1)

                                    <div class="form-group">
                                    {{ Form::label('type', 'Type:') }}
                                    <br>

                                    {{ Form::radio('type', 'SP') }} Service Provider<br>
                                    {{ Form::radio('type', 'SUB') }} SUB<br>





                                    @if($errors->has('type'))
                                        <p class="text-warning"> {{ $errors->first('type') }}</p>
                                    @endif
                                </div>
                                    @endif

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
                                    {{ Form::label('banner_img', 'Banner Image:') }}
                                    {{ Form::file('banner_img') }}
                                    @if($errors->has('banner_img'))
                                        <p class="text-warning"> {{ $errors->first('banner_img') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('external_uri', 'External URL:') }}
                                    {{ Form::text('external_uri', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('external_uri'))
                                        <p class="text-warning"> {{ $errors->first('external_uri') }}</p>
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


