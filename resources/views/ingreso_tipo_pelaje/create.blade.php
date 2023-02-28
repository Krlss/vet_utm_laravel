
@extends('layouts.admin')
@section('content')
<style>
div.input-group {
  text-transform: uppercase;
}

</style>

<div class="container">
      
    <div class="row justify-content-center">
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ingreso de Pelajes</div>
                   <div class="col-md-12">
               	
            		  <form action="{{url('/ingreso_tipo_pelaje')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}

                            <div class="input-group mb-3">
                              <div class="col-md-4">
                              <span>
                              <label for="nombre" class="col-md-8 col-form-label text-md-left" >{{'Especie'}}</label>
                              </span>
                              </div>

                              <div class="col-md-4">
                              <span><label for="tipo_pelaje" class="col-md-8 col-form-label text-md-left" >{{'Pelaje'}}</label> 
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
                             <span><input type="text"  onkeyup="this.value = this.value.toUpperCase();" class="form-control" name="tipo_pelaje" id="tipo_pelaje" value="">
                             </span>
                             </div>
                          </div>

                          

                            <input type="submit" class="btn btn-success" value="Agregar">
                            <a href="{{url('ingreso_tipo_pelaje')}}" class="btn btn-outline-info">Regresar</a>    
                      </form>
                        <br>
                    </div>
              </div>
         </div> 
     </div>
  </div>

@endsection