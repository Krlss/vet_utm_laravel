
@extends('layouts.admin')
@section('content')
<style>
div.input-group {
  
}

</style>

<div class="container">
      
    <div class="row justify-content-center">
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ingreso Anexos - Exámenes</div>
                   <div class="col-md-12">
               	      <label for="error" class="col-md-12 col-form-label text-md-left" >
                        @if(count($errors) > 0)
                            <div class="errors">
                                <ul style="color: red">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif
                        </label>
                    @foreach($mascota as $mas)
            		  <form action="{{url('/anexos/')}}" method="post" enctype="multipart/form-data">
                    @endforeach
                    
{{csrf_field()}}
<tr>
<label for="cod_mascota" class="col-md-4 col-form-label text-md-left" >{{'Codigo de Mascota:'}}</label>
<input type="text" class="form-control" name="cod_mascota" id="cod_mascota" value="{{$mas->cod_mascota}}" readonly> 
   </br>   
<label for="descripcion_anexo" class="col-md-4 col-form-label text-md-left" >{{'Descripcion:'}}</label>
<input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" name="descripcion_anexo" id="descripcion_anexo" value="">

<label for="fecha_anexo" class="col-md-4 col-form-label text-md-left" >{{'Fecha de anexo:'}}</label>
</br>
<input type="date" class="form-control-file border" name="fecha_anexo" id="fecha_anexo" value="">
</br>


<label for="documento_anexo" class="col-md-4 col-form-label text-md-left">{{'Archivo:'}}</label>
<input type="file" class="form-control-file border" name="documento_anexo" id="documento_anexo" value="">

</br>

<input type="submit" class="btn btn-success" value="Agregar">
<a href="{{url('anexos')}}" class="btn btn-outline-info">Regresar</a>
</br>
</br>

</form>

                        <br>
                    </div>
              </div>
         </div> 
     </div>
  </div>

@endsection