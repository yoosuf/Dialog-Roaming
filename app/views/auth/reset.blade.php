@extends('layouts.auth')

@section('main')

    {{ Form::open(['route' => 'forgot.trigger']) }}
    <div class="form-group has-feedback">

        {{ Form::label('password', 'Password:') }}
        {{ Form::password('password', ['class'=>'form-control span6', 'placeholder' => 'Please Enter a new Password']) }}

        <p class="errors">{{$errors->first('password')}}</p>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback">

        {{ Form::label('password_confirmation', 'Password confirmation:') }}
        {{ Form::password('password_confirmation', ['class'=>'form-control span6', 'placeholder' => 'Re enter your Password']) }}

        <p class="errors">{{$errors->first('password_confirmation')}}</p>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>


    <div class="social-auth-links text-center">

        <button type="submit" href="#" class="btn btn-block btn-social btn-primary btn-flat"><i class="fa fa-angle-double-right"></i> Change Password</button>

    </div><!-- /.social-auth-links -->



    {{ Form::close() }}



@stop


