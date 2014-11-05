@extends('admin.layouts.default')

<div class="container">


<h1>Editar Equipo</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{-- Form::open(array('url' => 'equips')) --}}
{{ Form::model($equips, array('route' => array('admin.equips.update', $equips->id), 'method' => 'PUT')) }}
     
	
		<div class="form-group">
		{{ Form::label('name', 'User Id') }}
		{{ Form::text('user_id', null, array('class' => 'form-control')) }}
		</div>


	<div class="form-group">

		{{ Form::label('tipo', 'Tipo') }}
		{{ Form::select('tipo',array( 'Totem'=>'Totem','Generador'=>'Generador', 'Compresor'=>'Compresor','Bombas'=>'Bombas','AIB'=>'AIB','Redes E'=>'Redes E'),null, array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('marcam', 'Marca Motor') }}
		{{ Form::text('marcam', null, array('class' => 'form-control')) }}
	</div>
	
	<div class="form-group">
		{{ Form::label('marcagc', 'Marca generador/Compresor') }}
		{{ Form::text('marcagc', null, array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('potencia', 'Potencia') }}
		{{ Form::text('potencia', null, array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('numeroequipo', 'Nº Equipo') }}
		{{ Form::text('numeroequipo', null, array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('tipobba', 'Tipo Bomba') }}
		{{ Form::text('tipobba', null, array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('qh', 'qh') }}
		{{ Form::text('qh', null, array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('capacidad', 'Capacidad') }}
		{{ Form::text('capacidad', null, array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('productotipo', 'Tipo Producto') }}
		{{ Form::text('productotipo', null, array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('numeropozo', 'Nº Pozo') }}
		{{ Form::text('numeropozo', null, array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('ubicacion', 'Ubicacion') }}
		{{ Form::text('ubicacion', null, array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('varios', 'Varios') }}
		{{ Form::text('varios', null, array('class' => 'form-control')) }}
	</div>


	
	</div>

	{{ Form::submit('Editar Equipo', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>