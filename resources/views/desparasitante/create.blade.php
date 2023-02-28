
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
                <div class="card-header">Ingreso Desparasitantes</div>
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
            		  <form action="{{url('/desparasitante')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}

                            <div class="input-group mb-3">
                              <div class="col-md-4">
                              <span>
                              <label for="especie" class="col-md-8 col-form-label text-md-left" >{{'Especie'}}</label>
                              </span>
                              </div>

                              <div class="col-md-4">
                              <span><label for="porcentaje" class="col-md-8 col-form-label text-md-left" >{{'Nom. Desparasitante'}}</label> 
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
                             <span><input type="text"  onkeyup="this.value = this.value.toUpperCase();" class="form-control" name="nom_desparasitante" id="nom_desparasitante" value="">
                             </span>
                             </div>
                          </div>
                            <br>
                            <input type="submit" class="btn btn-success" value="Agregar">
                            <a href="{{url('desparasitante')}}" class="btn btn-outline-info">Regresar</a>    
                      </form>
                        <br>
                    </div>
              </div>
         </div> 
     </div>
  </div>

@endsection