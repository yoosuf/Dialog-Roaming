@extends('layouts.scaffold')

@section('main')

<h1>New Menu Options</h1>

{{ Form::open(array('route' => 'menu-options.store')) }}
	<ul>
        <li>
            {{ Form::label('route_name', 'Route name:') }}
            {{ Form::text('route_name') }}
        </li>


        <li>
            {{ Form::label('menu_icon', 'menu icon:') }}
            {{ Form::file('menu_icon') }}
        </li>


        <li>
            {{ Form::label('show_below', 'show_below:') }}
            {{ Form::file('show_below') }}
        </li>

        <li>
            {{ Form::label('is_parent', 'is_parent:') }}
            {{ Form::checkbox('is_parent') }}
        </li>


        <li>
            {{ Form::label('is_hidden', 'is_hidden:') }}
            {{ Form::checkbox('is_hidden') }}
        </li>



		<li>
			{{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop


