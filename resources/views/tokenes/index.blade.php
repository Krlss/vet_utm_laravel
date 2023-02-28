

@extends('layouts.admin')

@section('content')
 <script>


$(document).ready(function(){
$(".boton").click(function(){

var xmlhttp = new XMLHttpRequest();
var xmlhttp2 = new XMLHttpRequest();
var xmlhttp3 = new XMLHttpRequest();
var valores=document.getElementById('usuario').value;
var valores2=document.getElementById('token').value;
var valores4=document.getElementById('urbanizacion').value;
var valores5=document.getElementById('id').value;


xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    
    var myObj = JSON.parse(this.responseText);
    
    var e1 = myObj[0].existencia;
    var mensaje="TOKEN ingresado no es valido"
    
if(e1 == "0")
     {
      
      if (confirm("TOKEN ingresado no es valido")) {
        location.replace("http://localhost:8080/skylar/public/tokenes")
      } else {
        location.replace("http://localhost:8080/skylar/public/home")
      }
         }
     else
     { 
      
       if (confirm("Su cuenta esta Activado")) {
        xmlhttp3.open("GET", "http://localhost:8080/skylar/servicios/editar_estado_usuario.php?id="+valores5+"&estado=Activado", true);
        xmlhttp3.send();
        xmlhttp2.open("GET", "http://localhost:8080/skylar/servicios/editar_estado_token.php?usuario="+valores+"&urbanizacion="+valores4+"&token="+valores2+"&estado=Activado", true);
        xmlhttp2.send();
        
        location.replace("http://localhost:8080/skylar/public/home")
      } else {
        location.replace("http://localhost:8080/skylar/public/home")
      }


     }
    
    
  }
};
xmlhttp.open("GET", "http://localhost:8080/skylar/servicios/consulta_token.php?token="+valores2+"&nombre_urbanizacion="+valores4, true);
xmlhttp.send();



});

});
</script>
<div class="container">
      
    <div class="row justify-content-center">
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Agrega el TOKEN de tu urbanizacion</div>
               <div class="col-md-12">
               	
            		<form action="{{url('/tokenes')}}" method="post" enctype="multipart/form-data">
{{csrf_field()}}
</br>
<label for="token" class="col-md-4 col-form-label text-md-left" >{{'Ingresa TOKEN:'}}</label>
<input type="text" class="form-control" name="token" id="token" value="">
</br>

<div align="center">
<input type="submit" class="boton"  value="Ingresar" href="{{url('/home')}}">
</div>
</br>
</br>
<h6>Este TOKEN tiene que ser entregado por el administrador de la urbanizacion, si usted no tiene el token favor de pedir ayuda al administrador.</h6>




</br>
</form>


 </div>
                </div>
                <label for="usuario" class="col-md-4 col-form-label text-md-left"  style="visibility: hidden">{{'usuario:'}}</label>
<input type="text" class="form-control" name="usuario" id="usuario" value="{{Auth::user()->name}}" style="visibility: hidden">


<label for="urbanizacion" class="col-md-4 col-form-label text-md-left" style="visibility: hidden">{{'Urbanizacion:'}}</label>
<input type="text" class="form-control" name="urbanizacion" id="urbanizacion" value="{{Auth::user()->urbanizacion}}" style="visibility: hidden">

<label for="estado" class="col-md-4 col-form-label text-md-left" style="visibility: hidden">{{'Estado:'}}</label>
<input type="text" class="form-control" name="estado" id="estado" value="Activado" style="visibility: hidden">

<label for="id" class="col-md-4 col-form-label text-md-left"  style="visibility: hidden">{{'id:'}}</label>
<input type="text" class="form-control" name="id" id="id" value="{{Auth::user()->id}}" style="visibility: hidden">

            </div>

           
        </div>
 	 
    </div>



@endsection