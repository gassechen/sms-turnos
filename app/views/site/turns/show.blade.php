@extends('site.layouts.panel')

@section('content')



<div class="row">
      <div class="col-lg-4">
            <div class="panel panel-primary">
              <div class="panel-heading">
            	   
                <h3 class="panel-title"><i class="fa fa-money">Emisor:</i> 
                  {{$username}}</h3>


               </div> 
              <div class="panel-body">
               



	<div class="jumbotron text-center">
		<h2>{{ $turn->name }}</h2>
		<p>
		
			 Fecha:<br><strong>{{ date("d/m/y -H:i ", strtotime($turn->fecha)) }}</strong>Hrs<br><br>
       <a class="btn btn-small btn-success" href="{{ URL::to('turns/') }}">Volver</a>
		</p>
	</div>
  
  <span class="pull-right"><i>Fecha Emi:{{ date("d-m-Y H:i:s",strtotime('now'))}}Hs</i></span>
</div>

</div>
</div>
</div>
@section('scripts')
  <script type="text/javascript">
   $(document).ready(function()
{
  $(".row").bind("click",function()
  {
    $(.row).printArea();
  });
});

  </script>
@stop


@endsection

