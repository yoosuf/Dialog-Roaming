@extends('layouts.scaffold')

@section('main')


    <section class="content-header">
        <h1>
            Partner Profile
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Partner Profile</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">


                    {{ Form::model($data, array('method' => 'PATCH', 'route' => array('profile'))) }}


                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    {{ Form::label('partner_name', 'Partner name:') }}
                                    {{ Form::text('partner_name', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('partner_name'))
                                        <p class="text-warning"> {{ $errors->first('partner_name') }}</p>
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
