@extends('layouts.auth')

@section('main')

    {{ Form::open(['route' => 'forgot.trigger']) }}
    <div class="form-group has-feedback">

        {{ Form::label('email', 'Email:') }}
        {{ Form::text('email', null, ['class'=>'form-control span6','placeholder' => 'Please Enter your Email']) }}


        <p class="errors">{{$errors->first('username')}}</p>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>


    <div class="social-auth-links text-center">

        <button type="submit" href="#" class="btn btn-block btn-social btn-primary btn-flat"><i class="fa fa-angle-double-right"></i> Loging to Axiata Roming</button>

    </div><!-- /.social-auth-links -->



    {{ Form::close() }}



@stop


