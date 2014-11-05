@extends('admin.layouts.default')

<!-- app/views/nerds/index.blade.php -->

	<title> Lista Equipos</title>

<div class="container">

<nav class="navbar navbar-inverse">
	<div class="navbar-header">
		<a class="navbar-brand" href="{{ URL::to('admin/users') }}">Usuarios</a>
	</div>
	<ul class="nav navbar-nav">
		<li><a href="{{ URL::to('equips') }}">Ver  Equipos</a></li>
		<li><a href="{{ URL::to('admin/equips/create') }}">Crear Equipos</a>
	</ul>
</nav>

<h1>Lista Equipos</h1>

<!-- will be used to show any messages -->

<table id="equipos" class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>Equipo ID</td>
			<td>Tipo</td>
			<td>Numero</td>
			<td>User Id</td>
			<td>Actions</td>
		</tr>
	</thead>
	<tbody>
	@foreach($equips as $key => $value)
		<tr>
			<td>{{ $value->id }}</td>
			<td>{{ $value->tipo }}</td>
			<td>{{ $value->numeroequipo }}</td>
			<td>{{ $value->user_id }}</td>

			<!-- we will also add show, edit, and delete buttons -->
			<td>

				<!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
				<!-- we will add this later since its a little more complicated than the other two buttons -->

				<!-- show the nerd (uses the show method found at GET /nerds/{id} -->
				<a class="btn btn-small btn-success" href="{{ URL::to('admin/equips/' . $value->id) }}">Ver Equipo</a>

				<!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('admin/equips/' . $value->id . '/edit') }}">Editar Equipo</a>
				<!--//usuario aequipo -->

				<a class="btn btn-small btn-info" href="{{ URL::to('admin/equips/' . $value->id . '/users/create') }}"> User+Equipo</a>
				{{ Form::open(array('url' => 'admin/equips/' . $value->id, 'class' => 'pull-right')) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::submit('Borrar Equipo', array('class' => 'btn btn-warning')) }}
				{{ Form::close() }}

			</td>
		</tr>
	@endforeach
	</tbody>
</table>

</div>


@section('scripts')
	<script type="text/javascript">
		var oTable;
		$(document).ready(function() {
			oTable = $('#equipos').dataTable( {
				"sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
				"sPaginationType": "bootstrap",
				"oLanguage": {
					"sLengthMenu": "_MENU_ records per page"
				},
				"aaSorting": [[ 1, "desc" ]],
				"aoColumns": [
				null,
				null,
				null,
				null,
				null
				],
				
        		"oTableTools": {
           				// "sSwfPath": "../assets/js/copy_csv_xls_pdf.swf"

    					// "aButtons": ["copy", "csv", "pdf", "print"]			
                                    	}
                                    	});
                                 } );

	</script>
	

@endsection
