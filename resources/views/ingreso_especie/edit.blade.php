@extends('layouts.admin')

@section('content')
<div class="" style="width:10%">
      <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
      <div class="">
       <a href="{{url('/ingreso_especie')}}" class="btn btn-process w3-button w3-hover-yellow" ><img src="https://img.icons8.com/pastel-glyph/64/26e07f/back.png" height="40">Atras</a>
      </div>
     </div>
<div class="container">
      
    <div class="row justify-content-center">
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Especies</div>
               <div class="col-md-12">
               	
            		<form action="{{url('/ingreso_especie/'.$especie->id)}}" method="post" enctype="multipart/form-data">
{{csrf_field()}}
{{method_field('PATCH')}}

                          <div class="input-group mb-3">
                            <div class="col-md-4">
                            <span>
                            <label for="especie" class="col-md-8 col-form-label text-md-left">{{'Especie:'}}</label>
                            </span>
                            </div>

                    
                          </div> 

                          <div class="input-group mb-3">
                              
                            <div class="col-md-4">
                            <span><input type="text" onkeyup="this.value = this.value.toUpperCase();"  class="form-control" name="especie" id="especie" value="{{$especie->especie}}">
                            </span>
                            </div>
                          </div>
</br>

<input type="submit" class="btn btn-success" value="Modificar">
<a href="{{url('ingreso_especie')}}" class="btn btn-outline-info">Regresar</a>

</form>

 </div>
                </div>
            </div>

           
        </div>
 	 
    </div>



@endsection