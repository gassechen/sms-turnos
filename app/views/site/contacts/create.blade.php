@extends('site.layouts.panel')

@section('content')


<div class="row">
      <div class="col-lg-12">
            <div class="panel panel-primary">
              <div class="panel-heading">
            	    
                <h3 class="panel-title">Nuevo Contacto<i class="fa fa-money"></i> </h3>
                    
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  
<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all() )}}

{{ Form::open(array('url' => 'contacts')) }}

	<div class="form-group">
		{{ Form::label('cname', 'Nombre') }}
		{{ Form::text('cname', Input::old('cname'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('cemail', 'Email') }}
		{{ Form::email('cemail', Input::old('cemail'), array('class' => 'form-control')) }}
	</div>

	
		<p>"Ingresar sin el 0 y sin el 15 ej: 2994066572"</p>
	<div class="form-group">
		{{ Form::label('cnumtel', 'Telefono') }}
		{{ Form::text('cnumtel', Input::old('cnumtel'), array('class' => 'form-control','id'=>'cnumtel')) }}
	</div>
	<div class="form-group">
		{{ Form::label('ccategory', 'Categoria') }}
		{{ Form::text('ccategory', Input::old('ccategory'), array('class' => 'form-control','id'=>'ccategory')) }}
	</div>
	

	{{ Form::submit('Nuevo Contacto', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
</div>
</div>
</div>
</div>


@section('scripts')

<script type="text/javascript">
jQuery(function($){
   $("#cnumtel").mask("9999999999");
});

</script> 

	



@stop

@endsection
