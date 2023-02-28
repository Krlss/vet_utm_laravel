

@extends('layouts.admin')

@section('content')

@if(Session::has('Mensaje'))
<style>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
</style>

<div class="alert alert-success">
  <strong>{{Session::get('Mensaje')}}</strong> 
</div>
@endif

<div class="container">
      <div class="row justify-content-left">
    <div class="col-md-3">
            <div class="card">
            	
			<a href="{{url('/hoja_clinica/')}}" class="btn btn-success" >Regresar</a>

              </div>

   			  </div>
   			   </div>
   			   <br>
    <div class="row justify-content-center">
        
        <div class="col-md-12">
            <div class="card">
         <div style="overflow-x:auto;">      
<table class="table table-light">
	<thead class="thead-light">
		<tr>
		    <th>#</th>		
		   	<th>Hoja</th>	
			<th>Fecha</th>	
			<th>Lote</th>	
			<th>Horario</th>	
			<th>Marca</th>	
			<th>Gramaje	</th>
			<th>Saborizante</th>
			<th>Lot.Saborizante</th>
			<th>Colgadores</th>
			<th>Ganchos</th>	
			<th>Acciones</th>
		</tr>

	</thead>

	<tbody>
		@foreach($hoja_clinica as $hoja)
		<tr>
			<td>{{$loop->iteration}}</td>
		    <td>{{$hoja->cod_animal}}</td>
			<td>{{$hoja->cod_hoja_clinica}}</td>	
			<td>{{$hoja->fecha_registro}}</td>	
			<td>{{$hoja->nombre_mascota}}</td>	
			<td>{{$hoja->direccion}}</td>	
			<td>{{$hoja->correo}}</td>
			<td>{{$hoja->telefono}}</td>
			<td>{{$hoja->entorno}}</td>
			<td>{{$hoja->tipo_animal}}</td>
			<td>{{$hoja->paseos}}</td>	
			<td>
			 		<a href="{{url('/egresosencabezado/'.$egreso->id.'/egrestachos')}}" class="btn btn-warning">Tachos</a>
			 		
			 	<form method="post" action="{{url('/egresosencabezado/'.$egreso->id)}}">
			 		{{csrf_field()}}
			 		{{method_field('DELETE')}}
			 		<button type="submit" class="btn btn-danger" onclick="return confirm('¿Seguro deseas eliminar el dato?')">Eliminar</button>
			 	</form>
			 </td>
		</tr>
		@endforeach
	</tbody>

</table>
 </div>
                </div>
            </div>

            
        </div>
 	 
    </div>



@endsection

