

@extends('layouts.admin')

@section('content')

@if(Session::has('Mensaje'))
{{Session::get('Mensaje')}}
@endif

<div class="container">
      <div class="row justify-content-left">
    <div class="col-md-3">
            <div class="card">
            	
			<a href="{{url('/subirpdf/create')}}" class="btn btn-success" >Agregar nuevo archivo</a>

              </div>

   			  </div>
   			   </div>
   			   <br>
    <div class="row justify-content-center">
        
        <div class="col-md-12">
            <div class="card">
               
<table class="table table-light">
	<thead class="thead-light">
		<tr>
		   <th>#</th>	
		   <th>PDF</th>	
		   <th>Nombre del documento</th>	
		   
		   <th>Acciones</th>	


		</tr>

	</thead>

	<tbody>
		@foreach($subirpdf as $subirpd)
		<tr>
			 <td>{{$loop->iteration}}</td>

			 <td><a href="{{ asset('storage').'/'.$subirpd->pdf}} " target="_blank"><img src="http://www.caldera.cl/2017/wp-content/uploads/2017/06/pdf-logo.png" alt="" width="35" ></a></td>
			 <td>{{$subirpd->nombre_pdf}}</td>
	
			 <td>
			 		<a href="{{url('/subirpdf/'.$subirpd->id.'/edit')}}" class="btn btn-warning">Editar</a>
			  

			 	<form method="post" action="{{url('/subirpdf/'.$subirpd->id)}}">
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



@endsection

