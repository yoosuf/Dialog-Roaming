@extends('layouts.scaffold')

@section('main')
    <section class="content-header">
        <h1>
            Partner / New
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"> Partner/New</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">

                    {{ Form::open(array('route' => 'partners.store')) }}


                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">


                                <div class="form-group">
                                    {{ Form::label('user_id', 'User:') }}
                                    {{ Form::select('user_id', $partner_users, null, ['class' => 'form-control'] ) }}
                                    @if($errors->has('user_id'))
                                        <p class="text-warning"> {{ $errors->first('user_id') }}</p>
                                    @endif
                                </div>


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
                        {{ Form::submit('Submit', array('class' => 'btn btn-info')) }}

                    </div>


                    {{ Form::close() }}
                </div>

            </div>
            <!--/.col (left) -->
        </div>
    </section>
@stop


