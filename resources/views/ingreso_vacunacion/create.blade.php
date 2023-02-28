@extends('layouts.admin')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- FUNCION PARA OCULTAR Y MOSTRAR DIV O FROM -->
<script type="text/javascript">
$(document).ready(function() {
    $("input[type=radio]").click(function(event){
        var valor = $(event.target).val();
        if(valor =="si_mascota"){
            $("#div1").show();
        } else if (valor == "no_mascota") {
            $("#div1").hide();
        } else if (valor == "si_paseo") {
            $("#div2").show();
        }
        else if (valor == "no_paseo") {
            $("#div2").hide();
            $("#frecuencia_paseo").val('0');
        }
              

    });
    });

</script>

<script type="text/javascript">
      $(document).ready(function() {
      $("#sexo").on("keyup",function(event){
        var sexo = $("#sexo").val()
        else if (sexo == "MACHO") {
                $("#div_macho").show();
                $("#div_hembra").hide();
            }
            else if (sexo == "HEMBRA") {
                $("#div_macho").hide();
                $("#div_hembra").show();
            }
            else
              {
                $("#div_macho").hide();
                $("#div_hembra").hide();
            }
        });
});
</script>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>

<!-- Funcion para extraer data base64 de la imagen -->
<script type="text/javascript">
function Pluss(){   
  var canvas = document.getElementById('myCanvas');
var canvasData = canvas.toDataURL("image/png");
document.getElementById("Imagen").value = canvasData;
}
</script>

<script src="https://code.jquery.com/jquery-2.2.2.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!-- Funcion para extraer data base64 de la imagen -->
<script type="text/javascript">
  function habilita() {
   var id = event.target.name.replace("radio","");
   elementos = document.querySelectorAll(".inputText[name=Accion"+id+"], .inputText[name=Hallazgo"+id+"]");
   for (var i = 0; i < elementos.length; i++) {
   elementos[i].disabled = false;
    }
  }

  function deshabilita() {
   var id = event.target.name.replace("radio","");
   elementos = document.querySelectorAll(".inputText[name=Accion"+id+"], .inputText[name=Hallazgo"+id+"]");
   for (var i = 0; i < elementos.length; i++) {
   elementos[i].disabled = true;    
      }
  
      //Esta es la función que una vez se cargue el documento será gatillada.
      $(function(){
         $("#tipo_especie").val('0');
         document.getElementById('cantidad').value="";
        });
     }
    </script>

<!-- FUNCION PARA CARGAR LA FECHA ACTUAL -->
<script>
window.onload = function(){
  var fecha = new Date(); //Fecha actual
  var mes = fecha.getMonth()+1; //obteniendo mes
  var dia = fecha.getDate(); //obteniendo dia
  var ano = fecha.getFullYear(); //obteniendo año
  if(dia<10)
    dia='0'+dia; //agrega cero si el menor de 10
  if(mes<10)
    mes='0'+mes //agrega cero si el menor de 10
  document.getElementById('fechaActual').value=ano+"-"+mes+"-"+dia;
}
</script>

<script type="text/javascript">
    $(function(){
        $('#nom_sistema').on('change',onSelectSistema);
    });

    function onSelectSistema() {
        var sistema_id = $(this).val();
        alert(sistema_id);    

        //AJAX


    }
</script>

<!-- FIN FUNCIONES -->
     <div class="" style="width:10%">
      <div class="">
       <a href="{{url('/hoja_clinica/examen_fisico_update')}}" class="btn btn-process w3-button w3-hover-yellow" ><img src="https://img.icons8.com/pastel-glyph/64/26e07f/back.png" height="40">Atras</a>
      </div>
     </div>

<body style="background-color:#FFFFFF;">
<div class="container"> 
  <div class="w3-row">
    <div class="w3-col w3-container" style="width:18%"><img src="{{asset('storage/imagenesserver/simbolo.png')}}" width="180" height="160"></div>
    <div class="w3-col w3-container"  style="width:64%; text-align:center;">
    <h2>Universidad Tecnica de Manabi</h2>
    <h2>Facultad de Medicina Veterinaria</h2>
    <h3>Clínica Veterinaria "Dr. Gabriel Manzo Quiñonez"</h3>
    <br>
    <h2><b>HISTORIA CLÍNICA</b></h2>

    </div>
    <div class="w3-col w3-container" style="width:18%"><img src="{{asset('storage/imagenesserver/vet.png')}}"   width="180" height="160"></div>
  </div>
  <br>
  <br>
     <!-- DATOS GENERALES -->
    <p><b>I. GENERALES.</b></p>


<div align="center">
 <table class="table table-light">
      @foreach($mascota as $pet)
      <thead class="table">
       <tr>
        <td class="w3-border" style="width:30%">Fecha:<input disabled type="date" id="fecha_consulta" style="width:70%; text-align:center;" value="" ></td>

        <!--<td class="w3-border" style="width:35%">Registro: <input disabled type="text" name="registro" id="registro" style="width:70%; text-align:center;" value="" ></td>
        -->

        <td class="w3-border" style="width:35%"># H. Clínica: <input disabled type="text"name="cod_mascota" id="cod_mascota" style="width:70%; text-align:center;" value="{{$pet->cod_mascota}}"></td>
       </tr>
       @endforeach
      </thead>
 </table>
</div>

<div>
    <p>LISTA DE PROBLEMAS:</p>
    <div align="center">
<table class="table table-light" id="dynamic_field">
  <thead class="table-success">
    <tr>
       <th class="w3-border" style="width:30%">Lista maestra</th>    
       <th class="w3-border" style="width:30%">Lista de problemas</th>  
       <th class="w3-border" style="width:30%">Diagnostico diferencial</th>
       <th class="w3-border" style="width:10%">Acción</th>
    </tr>
  </thead>
  <tbody>
    <tr >
      <tr> 
        <td class="w3-border">
           <span>
              <select class="form-control" name="sistema[]"  id="sistema"  value="">
              @foreach($lista_maestra as $nom_lis)
              <option value="{{$nom_lis->id}}">{{$nom_lis->nom_sistema}}</option>
              @endforeach
              </select>
           </span>
        </td> 
        <td class="w3-border">
           <span>
              <select class="form-control" name="problema[]"  id="problema"  value="">
              @foreach($lista_maestra as $nom_lis)
              <option value="{{$nom_lis->id}}">{{$nom_lis->nom_sistema}}</option>
              @endforeach
              </select>
           </span>
        </td>
        
        <td class="w3-border "><input class="form-control" type="textarea" name="diagnostico_diferencial[]" id="diagnostico_diferencial" value="" style="width:100%"></td>
        <td class="w3-border "><button type="button" name="add" id="add" class="btn btn-success form-control"> + </button></td>  
    </tr>
    </tr>
    
  </tbody>
  </table>

   </div>
    
   </div>

</div>

 <div class="w3-right" style="width:10%">
      <div class="">
        @foreach($mascota as $pet)
       <a href="{{url('/hoja_clinica/plan_terapeutico/'.$pet->cod_mascota.'/')}}" class="btn btn-process  w3-button w3-hover-yellow" ><img src="https://img.icons8.com/external-becris-lineal-becris/64/26e07f/external-next-mintab-for-ios-becris-lineal-becris.png"height="40"> Siguiente</a>
       @endforeach
      </div>
      <br>
      <br>
   </div>
<script type="text/javascript">
$(document).ready(function(){      
var url = "{{ url('add-remove-input-fields') }}";
var i=1;  
$('#add').click(function(){  
var title = $("#title").val();
var nom_sistema = $("#nom_sistema").val();
var nom_problema = $("#nom_problema").val();
var diagnostico_diferencial = $("#diagnostico_diferencial").val();
i++;  
$('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td class="w3-border"><span><select class="form-control" name="sistema[]"  id="sistema"  value="'+ nom_sistema +'">@foreach($lista_maestra as $nom_lis)<option value="{{$nom_lis->id}}">{{$nom_lis->nom_sistema}}</option>@endforeach              </select></span></td><td class="w3-border"><span><select class="form-control" name="problema[]"  id="problema"  value="'+ nom_problema +'">@foreach($lista_maestra as $nom_lis)<option value="{{$nom_lis->id}}">{{$nom_lis->nom_sistema}}</option>@endforeach</select></span></td><td class="w3-border "><input class="form-control" type="textarea" name="diagnostico_diferencial[]" id="diagnostico_diferencial" value="'+ diagnostico_diferencial +'" style="width:100%"></td><td class="w3-border"><button type="button" name="remove" id="'+i+'" class="btn btn-danger form-control btn_remove">X</button></td></tr>');  
});  
$(document).on('click', '.btn_remove', function(){  
var button_id = $(this).attr("id");   
$('#row'+button_id+'').remove();  
});  
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$('#submit').click(function(){            
$.ajax({  
url:"{{ url('add-remove-input-fields') }}",  
method:"POST",  
data:$('#add_name').serialize(),
type:'json',
success:function(data)  
{
if(data.error){
display_error_messages(data.error);
}else{
i=1;
$('.dynamic-added').remove();
$('#add_name')[0].reset();
$(".show-success-message").find("ul").html('');
$(".show-success-message").css('display','block');
$(".show-error-message").css('display','none');
$(".show-success-message").find("ul").append('<li>Todos Has Been Successfully Inserted.</li>');
}
}  
});  
});  
function display_error_messages(msg) {
$(".show-error-message").find("ul").html('');
$(".show-error-message").css('display','block');
$(".show-success-message").css('display','none');
$.each( msg, function( key, value ) {
$(".show-error-message").find("ul").append('<li>'+value+'</li>');
});
}
});  
</script>
</body>



@endsection