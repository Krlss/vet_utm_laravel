@extends('layouts.admin')

@section('content')

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
      <thead class="table">
       <tr>
        <td class="w3-border" style="width:30%">Fecha:<input disabled type="date" id="fecha_generado" style="width:70%; text-align:center;" ></td>

        <td class="w3-border" style="width:35%">Registro: <input disabled type="text" name="registro" id="registro" style="width:70%; text-align:center;" ></td>

        <td class="w3-border" style="width:35%"># H. Clínica: <input disabled type="text"name="num_historia" id="num_historia" style="width:70%; text-align:center;" ></td>
       </tr>
      </thead>
 </table>
</div>

</div>
<div>
    <p>PLAN TERAPEUTICO:</p>
    <div align="center">
<table class="table table-light" id="dynamic_field">
  <thead class="table-success">
    <tr>
       <th class="w3-border" style="width:10%">Tipo T.</th>    
       <th class="w3-border" style="width:15%">Principio A.</th>  
       <th class="w3-border" style="width:15%">Presentacion</th>
       <th class="w3-border" style="width:10%">Cant.</th>
       <th class="w3-border" style="width:10%">Hora</th>
       <th class="w3-border" style="width:10%">Dosis</th>
       <th class="w3-border" style="width:15%">Via</th>
       <th class="w3-border" style="width:15%">Frec. Duracion</th>
       <th class="w3-border" style="width:15%">Acc.</th>
    </tr>
  </thead>
  <tbody>
    <tr >
      <tr> 
        <td class="w3-border">
           <span>
              <select class="form-control" name="t_terapia[]"  id="t_terapia"  value="">
              <option value="0">TS</option>
              <option value="1">P</option>
              <option value="2">S</option>
              <option value="3">E</option>
              </select>
           </span>
        </td> 
        <td class="w3-border">
           <span>
              <select class="form-control" name="p_activo[]"  id="p_activo"  value="">
              <option value="0">Natural</option>
              <option value="1">Quimico</option>
              </select>
           </span>
        </td>
        <td class="w3-border">
           <span>
              <select class="form-control" name="presentacion[]"  id="presentacion"  value="">
              <option value="0">Tableta</option>
              <option value="1">Suspension</option>
              <option value="2">Ampolla</option>
              </select>
           </span>
        </td>
        <td class="w3-border">
           <span>
              <select class="form-control" name="dosis_cant[]"  id="dosis_cant"  value="">
              <option value="0">1</option>
              <option value="1">2</option>
              <option value="2">3</option>
              </select>
           </span>
        </td>
        <td class="w3-border">
           <span>
              <select class="form-control" name="dosis_tiempo[]"  id="dosis_tiempo"  value="">
              <option value="0">2</option>
              <option value="1">4</option>
              <option value="2">6</option>
              <option value="2">8</option>
              </select>
           </span>
        </td>
        <td class="w3-border">
           <span>
              <select class="form-control" name="dosis_administra[]"  id="dosis_administra"  value="">
              <option value="0">50mg</option>
              <option value="1">150mg</option>
              <option value="2">500mg</option>
              <option value="2">1gm</option>
              </select>
           </span>
        </td>
        <td class="w3-border">
           <span>
              <select class="form-control" name="via[]"  id="via"  value="">
              <option value="0">Oral</option>
              <option value="1">Sub-cutanea</option>
              <option value="2">Intramuscular</option>
              <option value="2">Rectal</option>
              </select>
           </span>
        </td>

        <td class="w3-border "><input class="form-control" type="textarea" name="frec_duracion[]" id="frec_duracion" value="" style="width:100%"></td>
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
       <a href="{{url('/hoja_clinica/')}}" class="btn btn-process  w3-button w3-hover-yellow" ><img src="https://img.icons8.com/external-becris-lineal-becris/64/26e07f/external-next-mintab-for-ios-becris-lineal-becris.png"height="40"> Finalizar</a>
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
$('#dynamic_field').append('');  
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