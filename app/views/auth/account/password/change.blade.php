@extends('layouts.scaffold')

@section('main')
    <section class="content-header">
        <h1>
            Change Password
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard">Dashboard</i></a></li>
            <li class="active">Change Password</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">

                    {{ Form::open(['route' => 'password']) }}
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group has-feedback">
                                    {{ Form::label('current_password', 'Current Password:') }}
                                    {{ Form::password('current_password', ['class'=>'form-control']) }}
                                    <p class="errors">{{$errors->first('current_password')}}</p>
                                </div>


                                <div class="form-group has-feedback">
                                    {{ Form::label('password', 'New Password:') }}
                                    {{ Form::password('password', ['class'=>'form-control']) }}
                                    <p class="errors">{{$errors->first('password')}}</p>
                                </div>


                                <div class="form-group has-feedback">
                                    {{ Form::label('password_confirmation', 'Confirm Password:') }}
                                    {{ Form::password('password_confirmation', ['class'=>'form-control']) }}
                                    <p class="errors">{{$errors->first('password_confirmation')}}</p>
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
        </div>

    </section>
@stop


