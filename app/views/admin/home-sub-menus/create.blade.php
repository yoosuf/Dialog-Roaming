@extends('layouts.scaffold')

@section('main')


    <section class="content-header">
        <h1>
            Home Sub Menu / New
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Home Sub Menu/New</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">


                    {{ Form::open(['route' => 'home-sub-menus.store',  'files' => true]) }}

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">






                                <div class="form-group">
                                    {{ Form::label('home_menu_id', 'Home Menu:') }}
                                    {{ Form::select('home_menu_id', $homeMenuList , null, ['class' => 'form-control']) }}
                                    @if($errors->has('home_menu_id'))
                                        <p class="text-warning"> {{ $errors->first('home_menu_id') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('option', 'Menu Type:') }}
                                    {{ Form::select('option', ['website' => 'Website', 'api' => 'API', 'partner' => 'Partner'] , null, ['class' => 'form-control']) }}
                                    @if($errors->has('option'))
                                        <p class="text-warning"> {{ $errors->first('option') }}</p>
                                    @endif
                                </div>


                                <div id="external_url" class="form-group">
                                    {{ Form::label('external_url', 'External url:') }}
                                    {{ Form::text('external_url', null, ['class' => 'form-control'] ) }}
                                    @if($errors->has('external_url'))
                                        <p class="text-warning"> {{ $errors->first('external_url') }}</p>
                                    @endif
                                </div>



                                <div id="external_api" class="form-group">
                                    {{ Form::label('service_provider_api_id', 'API:') }}
                                    {{ Form::select('service_provider_api_id', $homeMenuList , null, ['class' => 'form-control']) }}
                                    @if($errors->has('service_provider_api_id'))
                                        <p class="text-warning"> {{ $errors->first('service_provider_api_id') }}</p>
                                    @endif
                                </div>

                                <div id="partner_service" class="form-group">
                                    {{ Form::label('partner_service_id', 'Partner service:') }}
                                    {{ Form::select('partner_service_id', $partnerList , null, ['class' => 'form-control']) }}
                                    @if($errors->has('partner_service_id'))
                                        <p class="text-warning"> {{ $errors->first('partner_service_id') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('title', 'Title:') }}
                                    {{ Form::text('title', null, ['class' => 'form-control'] ) }}
                                    @if($errors->has('title'))
                                        <p class="text-warning"> {{ $errors->first('title') }}</p>
                                    @endif
                                </div>


                                <div class="form-group">
                                    {{ Form::label('description', 'Description:') }}
                                    {{ Form::textarea('description', null, ['class' => 'form-control'] ) }}
                                    @if($errors->has('description'))
                                        <p class="text-warning"> {{ $errors->first('description') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    {{ Form::label('banner_img', 'Banner image:') }}
                                    {{ Form::file('banner_img' ) }}
                                    @if($errors->has('banner_img'))
                                        <p class="text-warning"> {{ $errors->first('banner_img') }}</p>
                                    @endif
                                </div>









                                <div class="form-group">
                                    {{ Form::label('is_active', 'Status:') }}
                                    {{ Form::checkbox('is_active') }}
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



@section('script')

    <script>
        $(document).ready(function() {


            $('#external_url').hide();
            $('#external_api').hide();
            $('#partner_service').hide();



            var optionIndex = $("#option option:selected").index();

            if(optionIndex == 0 ){

                $('#external_url').show();

            } else if (optionIndex == 1 ){

                $('#external_api').show();

            } else if (optionIndex == 2 ){

                $('#partner_service').show();

            }


            $("#option").change(function() {


                if( $(this).val() == 'website' ) {

                    $('#external_url').show();
                    $('#external_api').hide();
                    $('#partner_service').hide();


                } else if ( $(this).val() == 'api' ) {

                    $('#external_api').show();
                    $('#external_url').hide();
                    $('#partner_service').hide();

                } else if ( $(this).val() == 'partner' ) {

                    $('#partner_service').show();
                    $('#external_url').hide();
                    $('#external_api').hide();

                } else {

                    $('#external_url').show();

                }

            });
        });
    </script>

@stop