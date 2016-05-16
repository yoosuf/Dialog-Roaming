@extends('layouts.auth')

@section('main')

    {{ Form::open(['action' => 'Admin\ProfileController@setupPassword']) }}

    <div class="form-group has-feedback">
        {{ Form::label('password', 'Password:') }}
        {{ Form::password('password', ['class'=>'form-control']) }}

        <p class="errors">{{$errors->first('password')}}</p>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>


    <div class="form-group has-feedback">
        {{ Form::label('password_confirmation', 'Confirm Password:') }}
        {{ Form::password('password_confirmation', ['class'=>'form-control']) }}

        <p class="errors">{{$errors->first('password')}}</p>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>


    <div class="social-auth-links text-center">

        <button type="submit" href="#" class="btn btn-block btn-social btn-primary btn-flat"><i class="fa fa-angle-double-right"></i> Create Password</button>

    </div><!-- /.social-auth-links -->



    {{ Form::close() }}



@stop


