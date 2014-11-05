@extends('site.layouts.panel')

@section('content')

<div class="row">
      <div class="col-lg-12">
            <div class="panel panel-primary">
              <div class="panel-heading">
            	    
                <h3 class="panel-title">Editar<i class="fa fa-money"></i> {{$turn->name}}</h3>
                    
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  


<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::model($turn, array('route' => array('turns.update', $turn->id), 'method' => 'PUT')) }}

	<div class="form-group">
		{{ Form::label('name', 'Name') }}
		{{ Form::text('name', null, array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('email', 'Email') }}
		{{ Form::email('email', null, array('class' => 'form-control')) }}
	</div>

	
	<div class="form-group">
		{{ Form::label('numtel', 'Telefono') }}
		{{ Form::text('numtel', Input::old('numtel'), array('class' => 'form-control','id'=>'cnumtel')) }}
	</div>

	<div class="form-group">	
	
		{{ Form::label('fecha', 'Fecha Proximo Turno') }}
		<br>
		{{ Form::text('fecha', Input::old('fecha'), array('class' => 'input-append date form_datetime')) }}
		 
	</div>
	

	{{ Form::submit('Editar Turno !', array('class' => 'btn btn-primary')) }}

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


jQuery(function($){
   $("#cnumtel").mask("9999999999");
});





</script> 
@stop

@endsection
