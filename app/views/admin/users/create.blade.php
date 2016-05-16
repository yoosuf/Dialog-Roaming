@extends('layouts.scaffold')

@section('main')


    <section class="content-header">
        <h1>
            @if(Auth::user()->role_id == 1)
                User / New
            @else
                Partner / New
            @endif

            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"> @if(Auth::user()->role_id == 1)
                    User / New
                @else
                    Partner / New
                @endif</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">


                    {{ Form::open(['route' => 'users.store']) }}


                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">


                                <div class="form-group">
                                    {{ Form::label('username', 'Username:') }}
                                    {{ Form::text('username', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('username'))
                                        <p class="text-warning"> {{ $errors->first('username') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('email', 'Email:') }}
                                    {{ Form::text('email', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('email'))
                                        <p class="text-warning"> {{ $errors->first('email') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('password', 'Password:') }}
                                    {{ Form::password('password', ['class' => 'form-control elwidth2'] ) }}
                                    <p class="help-block">Password needs to be at least with one Capital Letter, Simple Letter a number and a symbol.</p>

                                @if($errors->has('password'))
                                        <p class="text-warning"> {{ $errors->first('password') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('password_confirmation', 'Password confirmation:') }}
                                    {{ Form::password('password_confirmation', ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('password_confirmation'))
                                        <p class="text-warning"> {{ $errors->first('password_confirmation') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('is_active', 'Status:') }}
                                    {{ Form::checkbox('is_active') }}
                                    @if($errors->has('is_active'))
                                        <p class="text-warning"> {{ $errors->first('is_active') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('role_id', 'Role:') }}
                                    {{ Form::select('role_id', ['' => 'select one']+$roles, null, ['class' => 'form-control elwidth2']) }}

                                    @if($errors->has('role_id'))
                                        <p class="text-warning"> {{ $errors->first('role_id') }}</p>
                                    @endif
                                </div>




                                <div id="service-provider" class="form-group">
                                    {{ Form::label('sp_name', 'Service Provider Name:') }}
                                    {{ Form::text('sp_name', null, ['class' => 'form-control elwidth2'] ) }}
                                    @if($errors->has('sp_name'))
                                        <p class="text-warning"> {{ $errors->first('sp_name') }}</p>
                                    @endif
                                </div>



                                <div id="partner" class="form-group">
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
                        {{ Form::submit('Create', array('class' => 'btn btn-info')) }}

                    </div>
                    {{ Form::close() }}


                </div>

            </div>
            <!--/.col (left) -->
        </div>
    </section>






@stop



@section('script')

    <script>
        $(document).ready(function() {

            $('#service-provider').hide();

            $('#partner').hide();


            if($("#role_id option:selected").index() == 1 ){

                $('#service-provider').show();
            } else if ($("#role_id option:selected").index() == 2 ){
                $('#partner').show();
            }

            $("#role_id").change(function() {

                if($(this).val() == 2) {

                    $('#service-provider').show();

                    $('#partner').hide();

                } else if ($(this).val() == 3) {

                    $('#partner').show();
                    $('#service-provider').hide();

                } else {
                    $('#partner').hide();
                    $('#service-provider').hide();

                }

            });
        });
    </script>

@stop

