@extends('layouts.admin')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registro de Mascotas') }}</div>
                
                <div class="card-body">
                    <form method="POST" action="{{ url('/ingreso_mascota') }}" enctype="multipart/form-data">
                        @csrf
                         <div class="form-group row">
                            <label for="ci_empleado" class="col-md-4 col-form-label text-md-right">{{Cedula'}}</label>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input id="ci_empleado" type="tel" class="form-control" name="ci_empleado"
                                    placeholder="1302121212 (10 digitos)"pattern="[0-9]{10}">
                                
                                  </div>   
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nombres_empleado" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="nombres_empleado" type="text" class="form-control @error('nombres_empleado') is-invalid @enderror" name="nombres_empleado" value="{{ old('nombres_empleado') }}" required autocomplete="nombres_empleado" autofocus onkeyup="  var start = this.selectionStart; var end = this.selectionEnd;  this.value = this.value.toUpperCase();  this.setSelectionRange(start, end);">

                                @error('text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="correo" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="correo" type="email" class="form-control @error('correo') is-invalid @enderror" name="correo" value="{{ old('correo') }}" required autocomplete="correo" >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="form-group row">
                            <label for="rol_empleado" class="col-md-4 col-form-label text-md-right">{{' Tipo de persona'}}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="rol_empleado" id="rol_empleado" value="">
                                
                                 
                                  <option>OPERADOR</option>
                                  <option>SUPERVISOR</option>
                                   
                                  
                                </select>
                            </div>
                        </div>

                      

                        <div class="form-group row">
                            <label for="ciudad" class="col-md-4 col-form-label text-md-right">{{' Ciudad'}}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="ciudad" id="ciudad" value="">
                                  
                                    <option>Seleccione...</option>
                                    <option>CHONE</option>
                                    <option>EL CARMEN</option>
                                    <option>FLAVIO ALFARO</option>
                                    <option>JIPIJAPA</option>
                                    <option>JUNÍN</option>
                                    <option>MANTA</option>
                                    <option>MONTECRISTI</option>
                                    <option>PAJÁN</option>
                                    <option>PEDERNALES</option>
                                    <option>PICHINCHA</option>
                                    <option>PORTOVIEJO</option>
                                    <option>ROCAFUERTE</option>
                                    <option>SANTA ANA</option>
                                    <option>SUCRE</option>
                                    <option>TOSAGUA</option>
                                  
                                </select>
                            </div>
                        </div>

                            <div class="form-group row">
                            <label for="telefono" class="col-md-4 col-form-label text-md-right">{{' Telefono/móvil'}}</label>

                            <div class="col-md-6">
                                <input id="telefono" type="tel" class="form-control" placeholder="0998989898 (10 digitos)" name="telefono" pattern="[0-9]{10}">
                            </div>
                        </div>

                     
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success" class="boton btn-primary">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection