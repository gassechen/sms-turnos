@extends('site.layouts.panel')

@section('content')



<div class="row">
      <div class="col-lg-12">
            <div class="panel panel-primary">
              <div class="panel-heading">
            	    
                <h3 class="panel-title"><i class="fa fa-money"></i> {{"SMS"}}</h3>
                   
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table id="totem" class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                    	

                      <tr>
                      	<th>Check <i class="fa fa-sort"></i></th>
                      	<th>ID <i class="fa fa-sort"></i></th>
                        <th>Nombre<i class="fa fa-sort"></i></th>
                        <th>Categoria<i class="fa fa-sort"></i></th>
                        
                        <th>Numero Tel <i class="fa fa-sort"></i></th>
                        
                        
                        
                      </tr>
                    </thead>
                    <tbody>
                    	@foreach($contacts as $value)
                      <tr>
                      	<td><input type="checkbox" id="selectall" name='check' value='{{ $value->id }}' /></td>
                      	<td>{{ $value->id }}</td>
            			      <td>{{ $value->cname }}</td>
            			      <td>{{ $value->ccategory }}</td>

            			      <td>{{ $value->cnumtel }}</td>
                        
						  
                      </tr>
                      @endforeach
                      </tbody>
                  </table>
                  <div id="demo">
      
                        <div class="demo-container">

                        </div>
                                  <button class = 'btn btn-success' type="submit">Agregar Contactos</button>
                          </div>  
					   
           </div>
           </div>
         </div>
       </div>
					<!--to show the pagination field-->
  
                <div class="text-right">
                  
                </div>
              </div>
              </div>
            <button type="submit">Submit form</button>
          </div>  
           </div>





           </div>
          
           
    



           
         </div>

 <div class="row">
      <div class="col-lg-12">
            <div class="panel panel-primary">
                            <div class="panel-heading">
                                
                              <h3 class="panel-title"><i class="fa fa-money"></i> {{"Mensaje"}}</h3>
                                  
                            </div>
                            <div class="panel-body">
                             
                        
                              

                                {{ Form::open(array('url' => 'messages/data' , 'class' => 'pull-right','id'=>'form1')) }}

                                
                        <h3>
                    {{ Form::textarea('mensaje',null, array('id'=>'texname' ,'class'=>'form-control input-lg', 'rows'=>'3')) }}
                  </h3>
                    <div class="text-right">
                      <div class="demo-container">
                                
                                </div>
                
                    {{ Form::submit('Nuevo SMS', array('class' => 'btn btn-primary')) }}
                   </div>
                    {{ Form::close() }}
                         

           </div>
        
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
				"aaSorting": [[ 2, "desc" ]],
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

var oTable;

$(document).ready(function() {
  $('#demo').click( function() {
    var sData = $('input[name=check]', oTable.fnGetNodes()).serialize();
   $( "div.demo-container" )
.html( '<td><input name=check value='+sData+'></td>' );
  alert("Contactos Cargados");
  
    //alert( "The following data would have been submitted to the server: \n\n"+sData );
    return false;
  } );
  
  oTable = $('#totem').dataTable();
} );


$(document).ready(function() {
$("#texname").characterCounter({
limit: 140, // characters limit
counterSelector: false, // allow one or more counters to be specified by a jQuery selector
counterWrapper: 'span', // the element you wish to wrap your counter in.
counterCssClass: 'text-success', // the CSS class to apply to your counter.
counterFormat: 'Te quedan %1 Caracteres', // the format of your counter text where '%1' will be replaced with the remaining character count.
counterExceededCssClass: 'text-danger', // the CSS class to apply when your limit has been exceeded.
onExceed: function(count) { if (count > 140 ) { alert("Ha superado la longitud del SMS")}; },
onDeceed: function(count) {},
customFields: {},}); // key value pairs of custom options to be added to the counter such as class, data attributes etc.
});

	</script>
	



@stop

@endsection
