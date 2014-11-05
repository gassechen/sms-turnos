@extends('admin.layouts.default')

<div class="container">


<h1>Nuevo Equipo</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'admin/equips')) }}
     
	<div class="form-group">
		{{ Form::label('usuario', 'Usuario') }}
		{{-- Form::select('usuario',$usuario, $selected, Input::old('usuario'), array('class' => 'form-control')) --}}
		{{ Form::select('usuario',$usuario, $selected, array('class' => 'form-control'))}}
	<div class="form-group">
		{{ Form::label('tipo', 'Tipo') }}
		{{ Form::select('tipo',array( 'Totem'=>'Totem','Generador'=>'Generador', 'Compresor'=>'Compresor','Bombas'=>'Bombas','AIB'=>'AIB','Redes E'=>'Redes E'), Input::old('tipo'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('marcam', 'Marca Motor') }}
		{{ Form::text('marcam', Input::old('marcam'), array('class' => 'form-control')) }}
	</div>
	
	<div class="form-group">
		{{ Form::label('marcagc', 'Marca generador/Compresor') }}
		{{ Form::text('marcagc', Input::old('marcagc'), array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('potencia', 'Potencia') }}
		{{ Form::text('potencia', Input::old('potencia'), array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('numeroequipo', 'Nº Equipo') }}
		{{ Form::text('numeroequipo', Input::old('numeroequipo'), array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('tipobba', 'Tipo Bomba') }}
		{{ Form::text('tipobba', Input::old('tipobba'), array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('qh', 'qh') }}
		{{ Form::text('qh', Input::old('qh'), array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('capacidad', 'Capacidad') }}
		{{ Form::text('capacidad', Input::old('capacidad'), array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('productotipo', 'Tipo Producto') }}
		{{ Form::text('productotipo', Input::old('productotipo'), array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('numeropozo', 'Nº Pozo') }}
		{{ Form::text('numeropozo', Input::old('numeropozo'), array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('ubicacion', 'Ubicacion') }}
		{{ Form::text('ubicacion', Input::old('ubicacion'), array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('varios', 'Varios') }}
		{{ Form::text('varios', Input::old('varios'), array('class' => 'form-control')) }}
	</div>


	
	</div>

	{{ Form::submit('Crear Equipo', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>