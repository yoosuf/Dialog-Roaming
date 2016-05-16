@extends('layouts.scaffold')

@section('main')



    <section class="content-header">
        <h1>
            Service Providers
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Service Providers</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">


                    {{--<p>{{ link_to_route('service-providers.create', 'Add new') }}</p>--}}

                    @if ($data->count())
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Username</th>
                                <th>Service Provider</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{{ $item->user->username }}}</td>
                                    <td>{{{ $item->sp_name }}}</td>

                                    {{--<td>{{ link_to_route('service-providers.edit', 'Edit', array($item->id), array('class' => 'btn btn-info')) }}</td>--}}
                                    {{--<td>--}}
                                        {{--{{ Form::open(array('method' => 'DELETE', 'route' => array('service-providers.destroy', $item->id))) }}--}}
                                        {{--{{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}--}}
                                        {{--{{ Form::close() }}--}}
                                    {{--</td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        No Data Available
                    @endif


                </div>

            </div>
            <!--/.col (left) -->
        </div>
    </section>



@stop
