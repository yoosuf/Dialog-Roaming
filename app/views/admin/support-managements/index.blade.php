@extends('layouts.scaffold')

@section('main')

    <section class="content-header">
        <h1>
            Support Managements
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Support Managements</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">


                    <p>{{ link_to_route('support-managements.create', 'Add new') }}</p>

                    @if ($data->count())
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{{ $item->subject }}}</td>
                                    <td>{{{ $item->email }}}</td>
                                    <td>
                                        @if($item->is_active == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>




                                    <td>{{ link_to_route('support-managements.edit', 'Edit', array($item->id), array('class' => 'btn btn-info')) }}</td>
                                    <td>
                                        {{ Form::open(array('method' => 'DELETE', 'route' => array('support-managements.destroy', $item->id))) }}
                                        {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $data->links() }}


                    @else
                        No Data Available
                    @endif


                </div>
            </div>
        </div>
    </section>

@stop
