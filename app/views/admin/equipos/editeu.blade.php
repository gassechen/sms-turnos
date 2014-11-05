@extends('admin.layouts.default')

<div class="container">


<h1>Editar Equipo + Usuarios</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{-- Form::open(array('url' => 'equips')) --}}
{{ Form::model($equips, array('route' => array('admin.equips.users.update', $equips->id), 'method' => 'PUT')) }}
     
	
		<div class="form-group">
		{{ Form::label('name', 'User Id') }}
		{{ Form::text('user_id', null, array('class' => 'form-control')) }}
		</div>


	


	
	

	{{ Form::submit('Editar Equipo', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>