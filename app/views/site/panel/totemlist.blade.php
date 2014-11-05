@extends('site.layouts.panel')


@section('content')
<div class="col-lg-4">
  
  
	@foreach($mesures as $id=>$mesure)

            
            <div class="panel panel-primary">
            	
              <div class="panel-heading">
              	<span class="pull-right"><i>Ultimo Evento:{{ date("d-m-Y H:i:s",strtotime($mesure->fecha))}}Hs</i></span>
                <h3 class="panel-title"><i class="fa fa-money">EQUIPO: </i> 
                	{{  $mesure->equipos->numeroequipo}}</h3>



              </div>

              <div class="panel-body">
                
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped tablesorter">
                  <tr>
                   @if($mesure->status=='1')
                    
                       <td>Estado: <span class="label label-success">ON</span></td>
                        
                      @else
                        <td>Estado: <span class="label label-danger">OFF</span></td>

                      @endif

                        <td>Presion Head : <b>{{$mesure->presuresuc}} PSI</b><td>
                        <td>Presion Linea: <b>{{$mesure->presuredisc}} PSI</b></td>
                        <td>Q : <b></b></td>
                       
                   </tr>
                  </table>
                </div>

                <h3 id="progress-stacked">Nivel Totem</h3>
            		<div class="bs-example">
              			<div class="progress">
                        
                        {{$volumen[$id]}} Lts
                      @if($nivel[$id]<11)
                			   <div class="progress-bar progress-bar-danger" style="width:{{$nivel[$id]}}%"></div>
                      @elseif($nivel[$id]<31)  
                			   <div class="progress-bar progress-bar-warning" style="width:{{$nivel[$id]}}%"></div>
                			@elseif($nivel[$id]<101)                          
                			   <div class="progress-bar progress-bar-success" style="width:{{$nivel[$id]}}%"></div>
                			@endif
              			     </div>
            			     
            		</div>
              	
                
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped tablesorter">
                  <tr>
                        <td>Nº Pozo: <b>{{$mesure->equipos->ubicacion}}</b></td>
                        <td>Proveedor : <b>{{$mesure->equipos->varios}}</b><td>
                        <td>Tipo Producto: <b>{{$mesure->equipos->productotipo}}</b></td>
                        <td>Tipo Bba: <b>{{$mesure->equipos->tipobba}}</b></td>
                        <td>Capacidad: <b>{{$mesure->equipos->capacidad}}Lts</b></td>
                   </tr>
                  </table>

                </div>

                
                <div class="text-right">

                  
                  <a href="{{ URL::to('totem/'.$mesure->equip_id) }}">Ver Historico del equipo <i class="fa fa-arrow-circle-right"></i></a>
		    
			    
                </div>
              </div>
            </div>
            
            @endforeach
          </div>
        </div><!-- /.row -->
@endsection