@extends('layouts.auth')

@section('main')

    {{ Form::open(['route' => 'session.create']) }}
    <div class="form-group has-feedback">

        {{ Form::label('username', 'Username:') }}
        {{ Form::text('username', null, ['class'=>'form-control span6','placeholder' => 'Please Enter your Username']) }}


        <p class="errors">{{$errors->first('username')}}</p>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">

        {{ Form::label('password', 'Password:') }}
        {{ Form::password('password', ['class'=>'form-control span6', 'placeholder' => 'Please Enter your Password']) }}

        <p class="errors">{{$errors->first('password')}}</p>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="row">
        <div class="col-xs-8">
            <div class="checkbox icheck">
                <label>
                    <input type="checkbox"> Remember Me
                </label>
            </div>
        </div><!-- /.col -->
        <div class="col-xs-4">

        </div><!-- /.col -->
    </div>
    <div class="social-auth-links text-center">

        <button type="submit" href="#" class="btn btn-block btn-social btn-primary btn-flat"><i class="fa fa-angle-double-right"></i>Login to Travel App Admin Portal</button>


        <p>{{ HTML::link('/forgot', 'Forgot Password')}}</p>


    </div><!-- /.social-auth-links -->






    {{ Form::close() }}



@stop


