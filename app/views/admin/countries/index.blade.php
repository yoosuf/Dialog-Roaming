@extends('layouts.scaffold')

@section('main')



    <section class="content-header">
        <h1>
            Countries
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Countries</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">


                    <p>{{ link_to_route('countries.create', 'Add new ') }}</p>

                    @if ($data->count())
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Country Code</th>
                                <th>Country Name</th>
                                <th>Country Currency</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{{ $item->country_code }}}</td>
                                    <td>{{{ $item->country_name }}}</td>
                                    <td>{{{ $item->country_currency }}}</td>
                                    <td>{{ link_to_route('countries.edit', 'Edit', array($item->id), array('class' => 'btn btn-info')) }}</td>
                                    {{--<td>--}}
                                        {{--{{ Form::open(array('method' => 'DELETE', 'route' => array('countries.destroy', $item->id))) }}--}}
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
