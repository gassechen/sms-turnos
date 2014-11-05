@extends('admin.layouts.default')

<div class="container">

<h1>Showing {{ $equips->id }}</h1>

	<div class="jumbotron text-center">
		<h2>{{ $equips->tipo }}</h2>
		<p>
			{{ $equips->user_id }} 
			{{ $equips->tipo     }}  
			{{ $equips->marcam   }}  
			{{ $equips->marcagc  }}  
			{{ $equips->potencia  }} 
			{{ $equips->numeroequipo}}  
			{{ $equips->tipobba   }}    
			{{ $equips->qh         }}   
			{{ $equips->capacidad   }}  
			{{ $equips->productotipo }} 
			{{ $equips->numpozo   }} 
			{{ $equips->ubicacion  }}     
			{{ $equips->varios  }}   
					</p>
	</div>

</div>