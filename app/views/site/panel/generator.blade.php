@extends('site.layouts.panel')


@section('content')


<div class="row">
          <div class="col-lg-4">
          	
          	<div class="panel panel-primary">
            	
              <div class="panel-heading">
              	
                <h3 class="panel-title"><i class="fa fa-money"></i> 
                	{{$numeroequipo}}</h3>

              </div>

              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped tablesorter">
                  <tr>
              	    	 <td>Tension:<b>{{-- $promediops --}} </b> </td> 

                         <td>Corriente: <b>{{-- $promediodisc --}} </b></td>
                        <td>Capacidad: <b>Lts</b></td> 
              	       
                   </tr>
                  </table>
              </div>
              </div>
              </div>
              </div>
              </div>

          <div class="row">
           <div class="col-lg-4"> 
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-long-arrow-right" id="choices"></i> </h3>
              </div>
              <div class="panel-body">

                <div class="flot-chart">
                  <div class="flot-chart-content" id="placeholder"></div>
                </div>
                      
                      <p><label><input id="enableTooltip" type="checkbox" checked="checked"></input>Visible tooltip</label></p>

                <div class="text-right">
                  <a href="{{ URL::to('generatorlist') }}">Ver Lista de equipos <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>


<div class="row">
      <div class="col-lg-4">
            <div class="panel panel-primary">
              <div class="panel-heading">
            	    <input type="button" id="btnExport" value=" Export Table data into Excel " /> 
                <h3 class="panel-title"><i class="fa fa-money"></i> {{"equipo"}}</h3>
                    
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table id="totem" class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                    	

                      <tr>
                      	<th>Status <i class="fa fa-sort"></i></th>
                        <th>Fecha<i class="fa fa-sort"></i></th>
                        <th>Tension<i class="fa fa-sort"></i></th>
                        <th>Corriente <i class="fa fa-sort"></i></th>
                        <th>Nivel<i class="fa fa-sort"></i></th>
                        
                      </tr>
                    </thead>
                    <tbody>
                    	@foreach($mesures as $mesure)
                      <tr>
                      	<td>{{$mesure->status}}</td>
                        <td>{{date("d-m-Y H:i:s", strtotime($mesure->fecha))}}</td>
                        <td>{{-- $mesure->presuresuc --}}</td> 
                        <td>{{-- $mesure->presuredisc --}}</td> 
                        <td>{{-- $mesure->levelqmco --}}</td> 
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
                  <a href="{{ URL::to('generatorlist') }}">Ver Lista de equipos <i class="fa fa-arrow-circle-right"></i></a>
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
				null
				],
				
        		"oTableTools": {
           				// "sSwfPath": "../assets/js/copy_csv_xls_pdf.swf"

    					// "aButtons": ["copy", "csv", "pdf", "print"]			
                                    	}
                                    	});
                                 } );

	</script>


<script type="text/javascript">
$(function () {
    var datasets = {
    	
        "status": {
            label: "status",
            data: [@foreach($mesures as $mesure)[{{strtotime($mesure->fecha)*1000}}, {{$mesure->status}}],@endforeach [,]]
        },
        "tension": {
            label: "Tension",
            data: [@foreach($mesures as $mesure)[{{strtotime($mesure->fecha)*1000}}, {{$mesure->presuresuc}}],@endforeach [,]]
        },
        "corriente": {
            label: "Corriente",
            data: [@foreach($mesures as $mesure)[{{strtotime($mesure->fecha)*1000}}, {{$mesure->presuredisc}}],@endforeach [,]]
        },
        "nivel": {
            label: "Nivel",
            data: [@foreach($mesures as $mesure)[{{strtotime($mesure->fecha)*1000}}, {{$mesure->levelqmco}}],@endforeach [,]]
        }
    	
    };

    // hard-code color indices to prevent them from shifting as
    // countries are turned on/off
    var i = 0;
    $.each(datasets, function(key, val) {
        val.color = i;
        ++i;
    });
    
    // insert checkboxes 
    var choiceContainer = $("#choices");
    $.each(datasets, function(key, val) {
        choiceContainer.append('<input type="checkbox" name="' + key +
                               '" checked="checked" id="id' + key + '">' +
                               '<label for="id' + key + '">'
                                + val.label +   '</label>');
    });
    choiceContainer.find("input").click(plotAccordingToChoices);


    function plotAccordingToChoices() {
        var data = [];

        choiceContainer.find("input:checked").each(function () {
            var key = $(this).attr("name");
            if (key && datasets[key])
                data.push(datasets[key]);
        });

        if (data.length > 0)
            $.plot($("#placeholder"), data, {
                
             xaxis: { 
		    
                    mode: "time",
			timezone: "browser",
			//rotateTicks: 90,
                     // min: (new Date()).getTime()-30,
                      max: (new Date()).getTime()+1,
                    timeformat: "%d/%m/%y"},
             pan: {
 			              interactive: true
					         },

				    zoom: {
 			              interactive: true
					         },

            yaxis: {
              min:-10, max: 10,  tickSize: 1 
            },
            series: {
                    points: {
                      show: true,
                        radius: 2
                      },
                      lines: {
                    show: true
                      },
              shadowSize: 0},
              grid: {
              color: '#646464',
              borderColor: 'transparent',
              borderWidth: 20,
              clickable: true,
              hoverable: true}
            


            });

          $("<div id='tooltip'></div>").css({
            position: "absolute",
            display: "none",
            border: "1px solid #fdd",
            padding: "2px",
            "background-color": "#fee",
            opacity: 0.80
              }).appendTo("body");

    $("#placeholder").bind("plothover", function (event, pos, item) {

      if ($("#enablePosition:checked").length > 0) {
        var str = "(" + pos.x.toFixed(2) + ", " + pos.y.toFixed(2) + ")";
        $("#hoverdata").text(str);
      }

      if ($("#enableTooltip:checked").length > 0) {
        if (item) {
        
          var x = new Date(item.datapoint[0]),
             y = item.datapoint[1].toFixed(2);
		
		if (x.getHours()< 10 ){	var hora='0'+ x.getHours();}
		    else{ hora=x.getHours();}
		if (x.getMinutes()< 10){var minute='0'+ x.getMinutes();}
		    else{minute=x.getMinutes();}
			
    		$("#tooltip").html(item.series.label + " = " + y +"/ "+  hora + ":" +  minute  + ":" +  x.getSeconds())
        	    .css({top: item.pageY+5, left: item.pageX+5})
        	    .fadeIn(200);
    		
    		}
        
        else {
          $("#tooltip").hide();
        }
      }
    });

    $("#placeholder").bind("plotclick", function (event, pos, item) {
      if (item) {
        $("#clickdata").text(" - click point " + item.dataIndex + " in " + item.series.label);
        plot.highlight(item.series, item.datapoint);
      }
    });




    }

    plotAccordingToChoices();

    var placeholder = $("#placeholder");

    placeholder.bind("plotselected", function (event, ranges) {

        var from = Math.ceil(ranges.xaxis.from / 1000);
        var to = Math.ceil(ranges.xaxis.to / 1000);
        console.log(ranges.xaxis.from.toFixed(1) + " to " + ranges.xaxis.to.toFixed(1));

        plot = $.plot(placeholder, datasets, $.extend(true, {}, options, {
            xaxis: {
                min: from,
                max: to
            }
        }));
    });

    


    

});
</script>

<script type="text/javascript">

    $("#btnExport").click(function(e) 
    { window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#totem').html()));
	 e.preventDefault(); }); 
	 
</script>

@stop

@endsection


