@extends('layouts.scaffold')

@section('main')

<h1>User-access / New</h1>

{{ Form::open(['route' => 'user-access.store', 'files' => true]) }}
	<ul>
        <li>
            {{ Form::label('menu_option_id', 'menu_option:') }}
            {{ Form::text('menu_option_id') }}
        </li>



        <li>
            {{ Form::label('parameters', 'parameters:') }}
            {{ Form::textarea('parameters') }}
        </li>



        <li>
            {{ Form::label('description', 'Description:') }}
            {{ Form::textarea('description') }}
        </li>



        <li>
            {{ Form::label('menu_display_ord', 'menu_display_ord:') }}
            {{ Form::text('menu_display_ord') }}
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


