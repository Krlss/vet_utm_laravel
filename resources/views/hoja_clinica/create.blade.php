@extends('layouts.admin')

@section('content')

<!-- FUNCION PARA OCULTAR Y MOSTRAR DIV O FROM -->
<script type="text/javascript">
$(document).ready(function() {
    $("input[type=radio]").click(function(event){
        var valor = $(event.target).val();
        if(valor =="SI"){
            $("#div10").show();
        } else if (valor == "NO") {
            $("#div10").hide();
        } else if (valor == "SI") {
            $("#div2").show();
        }
        else if (valor == "NO") {
            $("#div2").hide();
            $("#frecuencia_paseo").val('0');
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
  function habilita_animal() {
   var otro_animal=event.target.id.replace("otro_animal","");
   otro_animal=1;
   var id=otro_animal;
   elementos = document.querySelectorAll(".inputText[name=otro_cantidad], .inputText[name=otro_especie]");
   for (var i = 0; i < elementos.length; i++) {
   elementos[i].disabled = false;
    }
  }

  function deshabilita_animal() {
   var otro_animal=event.target.id.replace("otro_animal","");
   otro_animal=1;
   var id=otro_animal;
   elementos = document.querySelectorAll(".inputText[name=otro_cantidad], .inputText[name=otro_especie]");
   for (var i = 0; i < elementos.length; i++) {
   elementos[i].disabled = true;    
      }
  
      //Esta es la función que una vez se cargue el documento será gatillada.
      $(function(){
         $("#otro_especie").val('0');
         document.getElementById('otro_cantidad').value="";
        });
     }
   function habilita_paseos() {
   var paseos=event.target.name.replace("paseos","");
   paseos=3;
   var id=paseos;
   elementos = document.querySelectorAll(".inputText[name=Accion"+id+"], .inputText[name=frec_paseos]");
   for (var i = 0; i < elementos.length; i++) {
   elementos[i].disabled = false;
    }
  }
  function deshabilita_paseos() {
   var paseos=event.target.name.replace("paseos","");
   paseos=3;
   var id=paseos;
   elementos = document.querySelectorAll(".inputText[name=Accion"+id+"], .inputText[name=frec_paseos]");
   for (var i = 0; i < elementos.length; i++) {
   elementos[i].disabled = true;    
      }
  
      //Esta es la función que una vez se cargue el documento será gatillada.
      /*$(function(){
         $("#tipo_especie").val('0');
         document.getElementById('cantidad').value="";
        });*/
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
  document.getElementById('fecha_consulta').value=ano+"-"+mes+"-"+dia;
  var age = calculateAge("10/06/1994");
  
  /*var sexo = document.getElementById('sexo').value;
           if (sexo == "MACHO") {
                $("#div_macho").show();
                $("#div_hembra").hide();
            }
           if (sexo == "HEMBRA") {
                $("#div_macho").hide();
                $("#div_hembra").show();
            }*/
        //alert( sexo , age );
// alert( age );

document.getElementById('edad_mascota').value=age;
}
</script>

<script>
function calculateAge(fechaNac) 
{
  const edadLegal = 18;
const esMayor = fechaNac => {
  if(!fechaNac || isNaN(new Date(fechaNac))) return;
  const hoy = new Date();
  const dateNac = new Date(fechaNac);
  if(hoy - dateNac < 0) return;
  const years = hoy.getUTCFullYear() - dateNac.getUTCFullYear();
  if(years < edadLegal) return false;
  if(years > edadLegal) return true;
  const meses = hoy.getUTCMonth() - dateNac.getUTCMonth();
  if(meses < 0) return false;
  if(meses > 0) return true;
  const dias = hoy.getUTCDate() - dateNac.getUTCDate();
  if(dias < 0) return false;
  return true;
}
const edad = fechaNac => {
  if(!fechaNac || isNaN(new Date(fechaNac))) return;
  const hoy = new Date();
  const dateNac = new Date(fechaNac);
  if(hoy - dateNac < 0) return;
  let dias = hoy.getUTCDate() - dateNac.getUTCDate();
  let meses = hoy.getUTCMonth() - dateNac.getUTCMonth();
  let years = hoy.getUTCFullYear() - dateNac.getUTCFullYear();
  if(dias < 0) {
    meses--;
    dias = 30 + dias;
  }
  if(meses < 0) {
    years--;
    meses = 12 + meses;
  }
  
  return [years, meses, dias];
}

$('#fechaNac').change(e => {
  let mayor = esMayor(e.currentTarget.value);
  let suEdad = edad(e.currentTarget.value);
  if(mayor) {
    //$('#salida').text(`Usted es mayor de ${edadLegal} años`);
  } else {
    if(mayor === false) {
    //$('#salida').text(`Usted es menor de ${edadLegal} años`);
    } else {
      //$('#salida').text('Fecha no válida, verifique');
    }
  }
  if(suEdad) {
    $('#edad').val(`${suEdad[0]} año(s), ${suEdad[1]} mes(es) y ${suEdad[2]} día(s).`);
  } else {
    $('#edad').val('');
  }
});
}
</script>

<!-- FIN FUNCIONES -->

@if(Session::has('Mensaje'))
<div class="alert alert-success">
  
  <strong>{{Session::get('Mensaje')}}</strong> 
</div>
@endif
     <div class="" style="width:10%">
      <div class="">
       <a href="{{url('/hoja_clinica/')}}" class="btn btn-process w3-button w3-hover-yellow" ><img src="https://img.icons8.com/pastel-glyph/64/26e07f/back.png" height="40">Atras</a>
      </div>
     </div>

<body style="background-color:#FFFFFF;">
<form action="{{url('/hoja_clinica')}}" method="post" enctype="multipart/form-data">
  {{csrf_field()}}
<div class="container">
  <div class="w3-row">
    <div class="w3-col w3-container" style="width:18%"><img src="{{asset('storage/imagenesserver/fci.jfif')}}" width="160" height="160"></div>
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
    <div class="row">

      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;">Fecha:</div>
      <div class="col" style="background-color:#FFFFFF;">
      <input class="form-control w3-center" type="date" id="fecha_consulta" name="fecha_consulta"value="" readonly></div>
      </div>
      <!-- 
      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;">Registro:</div>
      <div class="col" style="background-color:#FFFFFF;">
      <input type="text" class="form-control" name="registro" id="registro" value="">     
      </div>
      </div>
      -->
      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;" ># H. Clínica:</div>
      @foreach($mascota as $pet)
      <div class="col" style="background-color:#FFFFFF;"><input type="text" class="form-control w3-center" name="cod_mascota" id="cod_mascota" value="{{$pet->cod_mascota}}" readonly></div>
      @endforeach
      </div>

    </div>
    <br>
   <!-- DATOS DE CLIENTE -->
  <div>
    <p><b>II. DATOS DEL CLIENTE</b></p>
    
    <div class="row">
      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;">Nombre:</div>
      <div class="col" style="background-color:#FFFFFF;">
      <input type="text" class="form-control"  value="FRANK LAURO MOLINA REZABALA" readonly></div>
      </div>
      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;">C.I:</div>
      <div class="col" style="background-color:#FFFFFF;">
      @foreach($mascota as $pet)
      <input type="text" class="form-control" name="ci_cliente" id="ci_cliente" value="{{$pet->id_pet_pather}}" readonly></div>
      
    </div>
    </div>
    <div class="row">
      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;">Dirección:</div>
      <div class="col" style="background-color:#FFFFFF;">
      <input type="text" class="form-control" value="AV. GUAYAQUIL - CALLEJON BENITEZ" readonly></div>
      </div>
      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;">Teléfono:</div>
      <div class="col" style="background-color:#FFFFFF;">
      <input type="text" class="form-control" value="052632278" readonly></div>
    </div>
    </div>
    <div class="row">
      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;">Email:</div>
      <div class="col" style="background-color:#FFFFFF;">
      <input type="text" class="form-control" value="yayosiete@gmail.com" readonly></div>
      </div>
      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;">Celular:</div>
      <div class="col" style="background-color:#FFFFFF;">
      <input type="text" class="form-control" value="0996584227" readonly></div>
      </div>
    </div>
  </div>

  <br>
  <br>
  <!-- DATOS DEL PACIENTE -->
  <div>
    <p><b>II. DATOS DEL PACIENTE</b></p>
    <!-- INICIO DATOS -->
    <div class="row">
      @foreach($mascota as $pet)
      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;">Nombre:</div>
      <div class="col" style="background-color:#FFFFFF;">
      <input type="text" class="form-control" value="{{$pet->name}}" readonly></div>
      </div>
      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;">Especie:</div>
      <div class="col" style="background-color:#FFFFFF;">
      <input type="text" class="form-control w3-center" value="{{$pet->specie}}" readonly> 
      <!-- funcion que precargue todos los datos necesarios -->
      </div>
      </div>

      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;" >Raza:</div>
      <div class="col" style="background-color:#FFFFFF;"><input type="text" class="form-control" value="{{$pet->race}}" readonly></div>
      </div>
    </div>
    <div class="row">
      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;">Sexo:</div>
      <div class="col" style="background-color:#FFFFFF;">
      <input type="text" class="form-control" id="sexo" value="{{$pet->sex}}" readonly></div>
      </div>
      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;">Pelaje:</div>
      <div class="col" style="background-color:#FFFFFF;">
      <input type="text" class="form-control w3-center"  value="{{$pet->pelaje}}" readonly> 
      <!-- funcion que precargue todos los datos necesarios -->
      </div>
      </div>
      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;" >Característica:</div>
      <div class="col" style="background-color:#FFFFFF;"><input type="text" class="form-control" id="caracteristica" value="{{$pet->caracteristica}}" readonly></div>
      </div>
    </div>

    <div class="row">
      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;" >Nacimiento:</div>
      <div class="col" style="background-color:#FFFFFF; align:right;">
      <input class="form-control"  type="text" id="fechaNac" value="{{$pet->birth}}" readonly></div>
      </div>

      <!--<div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;">Edad:</div>
      <div class="col" style="background-color:#FFFFFF;">
      <input type="text" class="form-control" id="edad_mascota" value="" readonly>
     funcion que precargue todos los datos necesarios 
      </div>
      </div>-->
      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;" >Esterilizado:</div>
      <div class="col" style="background-color:#FFFFFF;"><input type="text" class="form-control w3-center" id="esterilizado" value="{{$pet->castrated}}" readonly></div>
      </div>
      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;">Alimentacion:</div>
      <div class="col" style="background-color:#FFFFFF;">
      <select class="form-control" name="alimentacion"  id="alimentacion" value="">
       <option>CASERA</option>
       <option>CONCENTRADA</option>
       <option>MIXTA</option>
      </select> 
      <!-- alimentacion con un select, lo demas esta precargado -->
      </div>
      </div>

    </div>
    @endforeach
    <!-- FIN DATOS -->

    <!-- INICIO DE ENTORNO -->
    <div>
    <p>ENTORNO:</p>
    <div class="row">

      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;">Habitad:</div>
      <div class="col" style="background-color:#FFFFFF;">
      <select class="form-control" name="habitad"  id="habitad"  value="">
       <option>CASA</option>
       <option>PATIO</option>
       <option>TERRAZA</option>
      </select>
      </div>
      </div>
      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;">Sombra:</div>
      <div class="col" style="background-color:#FFFFFF;">
      <select class="form-control" name="sombra"  id="sombra"  value="">
       <option>SI</option>
       <option>NO</option>
      </select>
      </div>
      </div>
      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;">Concreto:</div>
      <div class="col" style="background-color:#FFFFFF;">
      <select class="form-control" name="concreto"  id="concreto"  value="">
       <option>SI</option>
       <option>NO</option>
      </select>
      </div>
      </div>
    </div>
   </div>
   <!-- FIN DE ENTORNO -->

   <!-- INICIO DE OTROS ANIMALES -->
   <div>
    <p>OTROS ANIMALES:</p>
    <div class="row">
      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;">Animales:</div>
      <div class="col" style="background-color:#FFFFFF;">

      <label>  
      <input type='radio' id="otro_animal" name='otro_animal' value='SI'  onclick='habilita_animal()'> Si  
      </label>
      <label>  
        <input type='radio' id="otro_animal" name='otro_animal' value='NO'  onclick='deshabilita_animal()'> No  
      </label>

      </div>
      </div>

      <div id="div1" style="display:;">
      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;">Especie:</div>
      <div class="col" style="background-color:#FFFFFF;">
      <label>  
      <select  name="otro_especie"  id="otro_especie"  disabled class='inputText form-control'>
       <option value =""></option>
       @foreach($especie as $espe)
       <option>{{$espe->especie}}</option>
       @endforeach
      </select>
      </label>
      </div>
      </div>
      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;">Cantidad:</div>
      <div class="col" style="background-color:#FFFFFF;">
        <label>  
        <input type="number" name="otro_cantidad" id="otro_cantidad" disabled class='inputText form-control' > 
        </label>
      </div>
      </div>
      </div>
    </div>
   </div>
       <!-- FIN DE OTROS ANIMALES -->

   
   <div> <!-- ACCESO A SALIR -->
    <p>ACCESO A SALIR:</p>
    <div class="row">
      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;">Acceso a salir:</div>
      
      <div class="col" style="background-color:#FFFFFF;">

      <label>  
      <input type='radio' name='salir' value='SI'> Si  
      </label>
      <label>  
        <input type='radio' name='salir' value='NO'> No  
      </label>

      </div>
      </div>

      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;">Paseos:</div>
      
      <div class="col" style="background-color:#FFFFFF;">

      <label>  
      <input type='radio' name='paseos' value='SI' onclick='habilita_paseos()'> Si  
      </label>
      <label>  
        <input type='radio' name='paseos' value='NO' onclick='deshabilita_paseos()'> No  
      </label>

      </div>
      </div>

      <div id="div2" style="display:;">
      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;">Frecuencia (Semana):</div>
      <div class="col" style="background-color:#FFFFFF;">
      <label>  
      <select  name="frec_paseos" id="frec_paseos" disabled class='inputText form-control'>
       <option value ="0"></option>
       <option value ="1">1</option>
       <option value ="2">2 o 3</option>
       <option value ="3">4 o 5</option>
       <option value ="4">6 o 7</option>
       <option value ="5">Esporádico</option>
      </select>
      </label>
      </div>
      </div>
    </div>
   </div>
   </div> <!-- FIN DE ACCESO A SALIR -->

   <div> <!-- ACTIVIDAD REPRODUCTIVA -->
    <p>ACTIVIDAD REPRODUCTIVA:</p>
      <div class="row">
    
      <div class="col row w3-border" style="display:;">
      <div class="col" style="text-align:right; background-color:#FFFFFF;">Actividad:</div>
      <div class="col" style="background-color:#FFFFFF;">

      <label>  
      <input type='radio' name='monta' value="SI" onclick='habilita()'> SI  
      </label>
      <label>  
      <input type='radio' name='monta' value="NO" onclick='deshabilita()'> NO  
      </label>
      </div>
      

      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;">FECHA:</div>
      <div class="col" style="background-color:#FFFFFF;">
      <input type="date" name="fecha_monta" class='inputText form-control'>
      <!-- <label>  
      <select  name="Hallazgo4"  id="ultima_monta"  disabled class='inputText form-control'>
       <option value ="0"></option>
       <option value ="1">1</option>
       <option value ="2">2 o 3</option>
       <option value ="3">4 o 5</option>
       <option value ="4">6 o 7</option>
      </select>
      </label> -->
      </div>
      </div>
      </div>
      </div>
  

      <!--
      <div class="row">
      <div class="col row w3-border" id="div_hembra" style="display:;">
      <div class="col" style="text-align:right; background-color:#FFFFFF;">Actividad:</div>
      <div class="col" style="background-color:#FFFFFF;">

      <label>  
      <input type='radio' name='monta' value='SI' onclick='habilita()'> Si  
      </label>
      <label>  
      <input type='radio' name='monta' value='NO' onclick='deshabilita()'> No  
      </label>
      </div>
      
      
      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;">Ultima Estro:</div>
      <div class="col" style="background-color:#FFFFFF;">
      <input type="date" name="fecha_monta" disabled class='inputText form-control'>
      <label>  
      <select  name="Hallazgo5"  id="ultima_estro"  disabled class='inputText form-control'>
       <option value ="0"></option>
       <option value ="1">1</option>
       <option value ="2">2 o 3</option>
       <option value ="3">4 o 5</option>
       <option value ="4">6 o 7</option>
      </select>
      </label> 
      </div>
      </div>
      </div>
      </div>

    -->

 
   </div> <!-- FIN DE ACTIVIDAD REPRODUCTIVA -->

   <!-- INICIO DE PROFILAXIS -->
   <div>
    <p>PROFILAXIS:</p>
    <div class="row">
      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;">Desparasitación:</div>
      <div class="col" style="background-color:#FFFFFF;">

      <label>  
      <input type='radio' name='desparasitacion' value="SI" onclick='habilita()'> SI 
      </label>
      <label>  
        <input type='radio' name='desparasitacion' value="NO" onclick='deshabilita()'> NO 
      </label>

      </div>


      </div>

      <div id="div1" style="display:;">
      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;">Nombre:</div>
      <div class="col" style="background-color:#FFFFFF;">
      <label>  
      <select  name="nom_desparasitante"  id="nom_desparasitante" class='inputText form-control'>
       <option disabled selected hidden>Seleccione...</option>
       @foreach($desparasitante as $despa)
       <option>{{$despa->nom_desparasitante}}</option>
       @endforeach
       </select>
      
      </label>
      </div>
      </div>
      <div class="col row w3-border">
      <div class="col" style="text-align:right; background-color:#FFFFFF;">Fecha:</div>
      
        <label>  
        <input type="date" name="fecha_desparasitante" id="fecha_desparasitante" value=""  class='inputText form-control' > 
        </label>
      
      </div>
      </div>
    </div>
   </div> <!-- FIN DE PROFILAXIS -->

   </div> <!-- FIN DATOS DEL PACIENTE -->
    <br>

</div>
 <div class="w3-right" style="width:10%">
      <div class="">
       <input type="submit" class="btn btn-success" value="Siguiente">
       <a href="{{url('/hoja_clinica/examen_fisico/'.$pet->cod_mascota.'/')}}" class="btn btn-process  w3-button w3-hover-yellow" ><img src="https://img.icons8.com/external-becris-lineal-becris/64/26e07f/external-next-mintab-for-ios-becris-lineal-becris.png"height="40"> Siguiente</a>
      </div>
      <br>
      <br>
   </div>

   @endforeach
   </form>
</body>

 

@endsection