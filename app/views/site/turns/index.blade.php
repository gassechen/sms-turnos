@extends('site.layouts.panel')

@section('content')
<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif




<div class="row">
      <div class="col-lg-12">
            <div class="panel panel-primary">
              <div class="panel-heading">
            	    
                <h3 class="panel-title"><i class="fa fa-money"></i> {{"Turno"}}</h3>
                    
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table id="totem" class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                    	

                      <tr>
                      	<th>ID <i class="fa fa-sort"></i></th>
                        <th>Nombre<i class="fa fa-sort"></i></th>
                        <th>Email<i class="fa fa-sort"></i></th>
                        <th>Avisos <i class="fa fa-sort"></i></th>
                        <th>Numero Tel <i class="fa fa-sort"></i></th>
                        <th>Fecha  | Hora<i class="fa fa-sort"></i></th>
                        <th>Acciones<i class="fa fa-sort"></i></th>
                        
                      </tr>
                    </thead>
                    <tbody>
                    	@foreach($turns as $value)
                      <tr>
                      	<td>{{ $value->id }}</td>
            						<td>{{ $value->name }}</td>
            						<td>{{ $value->email }}</td>
            						<td>{{ $value->turn_level }}</td>

            						<td>{{ $value->numtel }}</td>
                        <td>{{ date("d/m/y - H:i ", strtotime($value->fecha)) }}</td>
						            <td>

							<!-- delete the turn (uses the destroy method DESTROY /turns/{id} -->
							<!-- we will add this later since its a little more complicated than the first two buttons -->
							{{ Form::open(array('url' => 'turns/' . $value->id, 'class' => 'pull-right')) }}
							{{ Form::hidden('_method', 'DELETE') }}
							{{ Form::submit('Borrar Turno', array('class' => 'btn btn-warning')) }}
							{{ Form::close() }}

								<!-- show the turn (uses the show method found at GET /turns/{id} -->
								<a class="btn btn-small btn-success" href="{{ URL::to('turns/' . $value->id) }}">Ver Turno</a>

								<!-- edit this turn (uses the edit method found at GET /turns/{id}/edit -->
								<a class="btn btn-small btn-info" href="{{ URL::to('turns/' . $value->id . '/edit') }}">Editar Turno</a>

						        </td>
                      </tr>
                      @endforeach
                      </tbody>
                  </table>
                  
					 </div>
           </div>
         </div>
       </div>
					<!--to show the pagination field-->
  
                <div class="text-right">
                  
                </div>
              </div>
              

@section('scripts')
	<script type="text/javascript">
		var oTable;
		$(document).ready(function() {
			oTable = $('#totem').dataTable( {
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


@stop

@endsection
