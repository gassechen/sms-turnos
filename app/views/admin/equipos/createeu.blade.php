@extends('admin.layouts.default')

<div class="container">


<h1>Equipo Agrega Usuario</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}
EQUIPO ID : {{-- $id--}}
{{ Form::open(array('url' => 'admin/equips/' . $equip_id . '/users')) }}

	<div class="form-group">
		{{ Form::label('equipo', 'Equipo') }}
		
		{{ Form::text('equipo',$equip_id, array('class' => 'form-control'))}}	
     
	<div class="form-group">
		{{ Form::label('usuario', 'Usuario') }}
		{{-- Form::select('usuario',$usuario, $selected, Input::old('usuario'), array('class' => 'form-control')) --}}
		{{ Form::select('usuario',$usuario, $selected, array('class' => 'form-control'))}}
	
	</div>

	{{ Form::submit('Equipo + Usuario', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>