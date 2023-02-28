
@extends('layouts.admin')
@section('content')
<style>
div.input-group {
  text-transform: uppercase;
}

</style>
<div class="" style="width:10%">
      <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
      <div class="">
       <a href="{{url('/ingreso_raza')}}" class="btn btn-process w3-button w3-hover-yellow" ><img src="https://img.icons8.com/pastel-glyph/64/26e07f/back.png" height="40">Atras</a>
      </div>
     </div>
<div class="container">
      
    <div class="row justify-content-center">
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ingreso de Raza</div>
                   <div class="col-md-12">
               	
            		  <form action="{{url('/ingreso_raza')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}

                            <div class="input-group mb-3">
                              <div class="col-md-4">
                              <span>
                              <label for="nombre" class="col-md-8 col-form-label text-md-left" >{{'Especie'}}</label>
                              </span>
                              </div>

                              <div class="col-md-4">
                              <span><label for="nom_raza" class="col-md-8 col-form-label text-md-left" >{{'Raza'}}</label> 
                              </span>
                              </div>

                            </div> 

                           

                          <div class="input-group mb-3">
                             <div class="col-md-4">
                             <span><select class="form-control" name="especie"  id="especie"  value="">
                                @foreach($especie as $espe)
                                <option>{{$espe->especie}}</option>
                                @endforeach
                                </select>
                             </span>
                             </div>

                             <div class="col-md-4">
                             <span><input type="text"  onkeyup="this.value = this.value.toUpperCase();" class="form-control" name="nom_raza" id="nom_raza" value="">
                             </span>
                             </div>
                          </div>

                          

                            <input type="submit" class="btn btn-success" value="Agregar">
                            <a href="{{url('ingreso_raza')}}" class="btn btn-outline-info">Regresar</a>    
                      </form>
                        <br>
                    </div>
              </div>
         </div> 
     </div>
  </div>

@endsection