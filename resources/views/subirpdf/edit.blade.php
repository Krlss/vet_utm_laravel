

@extends('layouts.admin')

@section('content')

<div class="container">
      
    <div class="row justify-content-center">
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Modicar Archivos PDF</div>
               <div class="col-md-12">
               	
            		<form action="{{url('/subirpdf/'.$subirpdf->id)}}" method="post" enctype="multipart/form-data">
{{csrf_field()}}
{{method_field('PATCH')}}


<label for="urbanizacion" class="col-md-4 col-form-label text-md-left">{{'Urbanizacion:'}}</label>
<select class="form-control" name="urbanizacion" id="urbanizacion" value="">
  @foreach($urbanizaciones as $urbanizacion)
  <option>{{$urbanizacion->nombre_urbanizacion}}</option>
  @endforeach
</select>

<label for="nombre_pdf" class="col-md-4 col-form-label text-md-left" >{{'Nombre del PDF:'}}</label>
<input type="text" class="form-control" name="nombre_pdf" id="nombre_pdf" value="{{$subirpdf->nombre_pdf}}">

<label for="pdf" class="col-md-4 col-form-label text-md-left">{{'PDF:'}}</label>
<input type="file" class="form-control-file border" name="pdf" id="pdf" value="">
</br>

</br>

<input type="submit" class="btn btn-success" value="Agregar">
<a href="{{url('subirpdf')}}" class="btn btn-outline-info">Regresar</a>

</form>

 </div>
                </div>
            </div>

           
        </div>
 	 
    </div>



@endsection