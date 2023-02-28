
@extends('layouts.admin')
@section('content')
<div class="" style="width:10%">
      <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
      <div class="">
       <a href="{{url('/ingreso_vacuna')}}" class="btn btn-process w3-button w3-hover-yellow" ><img src="https://img.icons8.com/pastel-glyph/64/26e07f/back.png" height="40">Atras</a>
      </div>
     </div>
<div class="container">
      
    <div class="row justify-content-center">
        
        <div class="col-md-8">
            <div class="card">
                
                <div class="card-header">Ingreso de vacunas</div>
                   <div class="col-md-12">
               	      <label for="numero_freidora" class="col-md-12 col-form-label text-md-left" >
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
            		  <form action="{{url('/ingreso_vacuna')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}

                          <div class="input-group mb-3">
                            <div class="col-md-4">
                            <span>
                            <label for="especie" class="col-md-8 col-form-label text-md-left">{{'Especie:'}}</label>
                            </span>
                            </div>

                            <div class="col-md-4">
                            <span><label for="nom_vacuna" class="col-md-8 col-form-label text-md-left">{{'Nom. Vacuna:'}}</label>
                            </span>
                            </div>

                          </div> 

                          <div class="input-group mb-3">
                              
                            <div class="col-md-4">
                              <span><select class="form-control" name="especie"  id="especie"  value="">
                               @foreach($especie as $pet)
                               <option>{{$pet->especie}}</option>
                               @endforeach
                              </select>
                              </span>
                              </div>

                            <div class="col-md-4">
                            <span><input type="text" class="form-control" name="nom_vacuna" id="nom_vacuna" value="">
                            </span>
                            </div>
                          </div>

                            <input type="submit" class="btn btn-success" value="Agregar">
                            <a href="{{url('ingreso_vacuna')}}" class="btn btn-outline-info">Regresar</a>
                      </form>

                    </div>
              </div>
         </div> 
     </div>
  </div>

@endsection