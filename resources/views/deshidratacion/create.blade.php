
@extends('layouts.admin')
@section('content')
<style>
div.input-group {
  
}

</style>
<div class="" style="width:10%">
      <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
      <div class="">
       <a href="{{url('/deshidratacion')}}" class="btn btn-process w3-button w3-hover-yellow" ><img src="https://img.icons8.com/pastel-glyph/64/26e07f/back.png" height="40">Atras</a>
      </div>
     </div>
<div class="container">
      
    <div class="row justify-content-center">
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ingreso Porcentajes</div>
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
            		  <form action="{{url('/deshidratacion')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}

                            <div class="input-group mb-3">
                              <div class="col-md-4">
                              <span>
                              <label for="especie" class="col-md-8 col-form-label text-md-left" >{{'Especie'}}</label>
                              </span>
                              </div>

                              <div class="col-md-4">
                              <span><label for="porcentaje" class="col-md-8 col-form-label text-md-left" >{{'%Deshidratación'}}</label> 
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
                             <span><input type="text"  onkeyup="this.value = this.value.toUpperCase();" class="form-control" name="porcentaje" id="porcentaje" value="">
                             </span>
                             </div>
                          </div>
                            <li>Nota: los porcentajes se deben ingresar sin el simbolo (%).</li>
                            <br>
                            <input type="submit" class="btn btn-success" value="Agregar">
                            <a href="{{url('deshidratacion')}}" class="btn btn-outline-info">Regresar</a>    
                      </form>
                        <br>
                    </div>
              </div>
         </div> 
     </div>
  </div>

@endsection