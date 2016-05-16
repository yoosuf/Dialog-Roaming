@extends('layouts.scaffold')

@section('main')


    <section class="content-header">
        <h1>
            User / Edit
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">User/Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">







                    {{ Form::model($data, ['method' => 'PATCH', 'route' => ['users.update', $data->id]]) }}



                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">



                                <div class="form-group">
                                    {{ Form::label('username', 'Username:') }}
                                    {{ Form::text('username', null, ['class' => 'form-control elwidth2', 'readonly'] ) }}
                                    @if($errors->has('username'))
                                        <p class="text-warning"> {{ $errors->first('username') }}</p>
                                    @endif
                                </div>



                                <div class="form-group">
                                    {{ Form::label('email', 'Email:') }}
                                    {{ Form::text('email', null, ['class' => 'form-control elwidth2', 'readonly'] ) }}
                                    @if($errors->has('email'))
                                        <p class="text-warning"> {{ $errors->first('email') }}</p>
                                    @endif
                                </div>


                                {{--<div class="form-group">--}}
                                    {{--{{ Form::label('password', 'Password:') }}--}}
                                    {{--{{ Form::password('password', ['class' => 'form-control elwidth2'] ) }}--}}
                                    {{--<p class="help-block">Password needs to be at least with one Capital Letter, Simple Letter a number and a symbol.</p>--}}
                                    {{--@if($errors->has('password'))--}}
                                        {{--<p class="text-warning"> {{ $errors->first('password') }}</p>--}}
                                    {{--@endif--}}
                                {{--</div>--}}



                                {{--<div class="form-group">--}}
                                    {{--{{ Form::label('password_confirmation', 'Password confirmation:') }}--}}
                                    {{--{{ Form::password('password_confirmation', ['class' => 'form-control elwidth2'] ) }}--}}
                                    {{--@if($errors->has('password_confirmation'))--}}
                                        {{--<p class="text-warning"> {{ $errors->first('password_confirmation') }}</p>--}}
                                    {{--@endif--}}
                                {{--</div>--}}




                                <div class="form-group">
                                    {{ Form::label('is_active', 'Status:') }}
                                    {{ Form::checkbox('is_active') }}
                                    @if($errors->has('is_active'))
                                        <p class="text-warning"> {{ $errors->first('is_active') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('role_id', 'Role:') }}
                                    {{ Form::select('role_id', $roles, null, ['class' => 'form-control elwidth2', 'disabled']) }}

                                    @if($errors->has('role_id'))
                                        <p class="text-warning"> {{ $errors->first('role_id') }}</p>
                                    @endif
                                </div>




                            </div>
                        </div>
                    </div>


                    <div class="box-footer">
                        {{ Form::submit('Update', array('class' => 'btn btn-info')) }}
                        {{ Form::close() }}

                        {{ Form::open(array('method' => 'POST', 'class' => 'form-inline',  'route' => array('users.reset', $data->id)) ) }}
                        {{ Form::submit('Reset Password', array('class' => 'btn btn-success')) }}
                        {{ Form::close() }}


                    </div>





                </div>

            </div>
            <!--/.col (left) -->
        </div>
    </section>






@stop




