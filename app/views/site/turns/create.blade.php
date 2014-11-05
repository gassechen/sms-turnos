@extends('site.layouts.panel')

@section('content')


<div class="row">
      <div class="col-lg-12">
            <div class="panel panel-primary">
              <div class="panel-heading">
            	    
                <h3 class="panel-title">Nuevo Turno<i class="fa fa-money"></i> </h3>
                    
              </div>
              <div class="panel-body">
                <div class="table-responsive">
      <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">            
<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all() )}}

{{ Form::open(array('url' => 'turns')) }}
	
	<div class="form-group">
		{{ Form::label('name', 'Nombre') }}
		{{ Form::text('name', Input::old('name'), array('class' => 'form-control input-lg','id'=>'cname','placeholder'=>'Ingrese Contacto' )) }}
	</div>


	<div class="form-group">
		{{ Form::label('email', 'Email') }}
		{{ Form::email('email', Input::old('email'), array('class' => 'form-control','id'=>'cemail','readonly'=>'readonly')) }}
	</div>

	<p>"Ingresar sin el 0 y sin el 15 ej: 2994066572"</p>	

	<div class="form-group">
		{{ Form::label('numtel', 'Telefono') }}
		{{ Form::text('numtel', Input::old('numtel'), array('class' => 'form-control','id'=>'cnumtel','readonly'=>'readonly')) }}
	</div>

	<div class="form-group">	
	
		{{ Form::label('fecha', 'Fecha Proximo Turno') }}
		<br>
		{{ Form::text('fecha', Input::old('fecha'), array('class' => 'input-append date form_datetime' )) }}
		 
	</div>
	
	

	{{ Form::submit('Nuevo turno', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
</div>
</div>
</div>
</div>


@section('scripts')

<script type="text/javascript">
$('.form_datetime').datetimepicker({
        language:  'es',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		
		
		format: "yyyy-mm-dd hh:ii"
    });

$(document).ready(function(){
    var ac_config = {
         
         source:[{{ $contacts }}],
                        
        select: function(event, ui){
            $("#cname").val(ui.item.cname);
            $("#cemail").val(ui.item.cemail);
            $("#cnumtel").val(ui.item.cnumtel);
        },
        minLength:1
    };
    $("#cname").autocomplete(ac_config);
});
jQuery(function($){
   $("#cnumtel").mask("9999999999");
});

</script>







</script> 
@stop

@endsection



