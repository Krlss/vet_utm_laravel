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
  
  var sexo = document.getElementById('sexo').value;
           if (sexo == "MACHO") {
                $('#div_macho').show();
                $('#div_hembra').hide();
                document.getElementById("div_hembra").style.visibility = 'hidden';
            }
           if (sexo == "HEMBRA") {
                $('#div_macho').hide();
                $('#div_hembra').show();
                document.getElementById("div_macho").style.visibility = 'hidden';
                
            }
        
}
</script>

<!-- FIN FUNCIONES -->
     <div class="" style="width:10%">
      <div class="">
       <a href="{{url('/hoja_clinica/create')}}" class="btn btn-process w3-button w3-hover-yellow" ><img src="https://img.icons8.com/pastel-glyph/64/26e07f/back.png" height="40">Atras</a>
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
        <td class="w3-border" style="width:30%">Fecha:<input disabled type="date" id="fecha_generado" style="width:70%; text-align:center;" ></td>

        <td class="w3-border" style="width:35%"><input type="text" name="sexo" id="sexo" style="width:70%; text-align:center;" value="{{$pet->sex}}" hidden="true"></td>

        <td class="w3-border" style="width:35%"># H. Clínica: <input disabled type="text"name="cod_mascota" id="cod_mascota" style="width:70%; text-align:center;" value="{{$pet->cod_mascota}}" ></td>
       </tr>
       @endforeach
      </thead>
 </table>
</div>

    
    <!-- INICIO EXAMEN FISICO -->
  <div>
    <p><b>IV. EXÁMEN FÍSICO</b></p>
    <div align="center">
<table class="table table-light">
  <thead class="table">
    <tr>
       <td class="w3-border" style="width:25%">Peso: <input type="number" id="peso" value="" style="width:40%; text-align:center;"> Kg. </td>    
       <td class="w3-border" style="width:25%">Temperatura: <input type="number" id="temperatura" value="" style="width:40%; text-align:center;" > ºC. </td>  
       <td class="w3-border" style="width:50%">
         <div class="col" style="background-color:#FFFFFF;">
         <label>  
            Deshidratación:  Si: <input type='radio' name='radio_des' value='SI' id="deshidratacion">   
         </label>
         <label>  
            No: <input type='radio' name='radio_des' value='NO' id="deshidratacion">   
         </label>
         <label>  
            Nivel: <select  name="porciento_deshidratacion"  id="porciento_deshidratacion">
                    <option></option>
                    @foreach($deshidratacion as $des)
                    <option>{{$des->porcentaje}}%</option>
                    @endforeach
                  </select>   
         </label>
         </div>
       </td> 
    </tr>
    <tr>
       <td class="w3-border" style="width:25%">F. Respiratoria:<input type="number" id="frec_respiratoria" value="" style="width:30%; text-align:center;" > rpm. </td>    
       <td class="w3-border" style="width:25%">F. Cardiaca:<input type="number" id="frec_cardiaca" value="" style="width:40%; text-align:center;" > lpm. </td>  
       <td class="w3-border" style="width:50%">T.LL.C.<input type="number" id="tllc" value="" style="width:40%; text-align:center;" > Seg. </td> 
    </tr>

    <tr>
       <td class="w3-border" style="width:25%">Otros: <input type="text" id="otros" value="" style="width:70%; text-align:left;" ></td>    
       <td class="w3-border" style="width:25%"></td>  
       <td class="w3-border" style="width:50%">
         <div class="col" style="background-color:#FFFFFF;">
         <label>  
            Mucosas:  <select  name="mucosas"  id="mucosas">
                    <option></option>
                    @foreach($mucosas as $muc)
                    <option>{{$muc->nom_mucosa}}</option>
                    @endforeach
                  </select>   
         </label>
         </div>
       </td> 
    </tr>
  </thead>


 </table>

</div>
   </div>
   <div>
    <p>LINFONODOS:</p>
    <div align="center">
<table class="table table-light">
  <thead class="table-success">
    <tr>
       <th class="w3-border" style="width:20%">Linfonodos</th>    
       <th class="w3-border" style="width:20%">Normales</th>  
       <th class="w3-border" style="width:60%">Comentarios</th> 
    </tr>
  </thead>
  <tbody>
    <tr>
       <td class="w3-border">Mandibulares</td>
       <td class="w3-border">
         <div class="col" style="background-color:#FFFFFF;">
         <label>  
            Si: <input type='radio' name='radio_m' value='SI' id="lm">   
         </label>
         <label>  
            No: <input type='radio' name='radio_m' value='NO' id="lm">   
         </label>
         </div>
       </td>
       <td class="w3-border"><input type="textarea" id="lm_comentario" value="" style="width:100%"></td>
    </tr>
    <tr>
       <td class="w3-border">Escapulares</td>
       <td class="w3-border">
         <div class="col" style="background-color:#FFFFFF;">
         <label>  
            Si: <input type='radio' name='radio_e' value='SI' id="le">   
         </label>
         <label>  
            No: <input type='radio' name='radio_e' value='NO' id="le">   
         </label>
         </div>
       </td>
       <td class="w3-border"><input type="textarea" id="le_comentario" value="" style="width:100%"></td>
    </tr>
    <tr>
       <td class="w3-border">Inguinales</td>
       <td class="w3-border">
         <div class="col" style="background-color:#FFFFFF;">
         <label>  
            Si: <input type='radio' name='radio_i' value='SI' id="li">   
         </label>
         <label>  
            No: <input type='radio' name='radio_i' value='NO' id="li">   
         </label>
         </div>
       </td>
       <td class="w3-border"><input type="textarea" id="li_comentario" value="" style="width:100%"></td>
    </tr>
    <tr>
       <td class="w3-border">Poplíteos</td>
       <td class="w3-border">
         <div class="col" style="background-color:#FFFFFF;">
         <label>  
            Si: <input type='radio' name='radio_p' value='SI' id="lp">   
         </label>
         <label>  
            No: <input type='radio' name='radio_p' value='NO' id="lp">   
         </label>
         </div>
       </td>
       <td class="w3-border"><input type="textarea" id="lp_comentario" value="" style="width:100%"></td>
    </tr>
  </tbody>
  </table>

   </div>
    
   </div>
   <br>
   <br>
   <div>
    <!-- INICIO DE PATRON DE DISTRIBUCION -->
    <p>PATRÓN DE DISTRIBUCIÓN:</p>
    
    <div class="row">
    <div class="w3-card-4" style="width:100%">
  
      <br>
      <br>
      <div class="w3-container w3-center">
      <div class="col" align="center" style="background-color:lavender;">
        <p>Nota:Remarque o señale las zonas afectadas</p>
      <canvas id="myCanvas" width="600" height="400"
      style="border:1px solid #FFFFFF;">
      Su navegador no soporta la manipulacion del patron de distribución</canvas>

      <script type="text/javascript">
        var canvas = document.getElementById("myCanvas");
        var ctx = canvas.getContext("2d");
        var img = new Image();
        img.src = "{{asset('storage/imagenesserver/patron_de_distribucion.png')}}";
        ctx.drawImage(img, 0, 0);
        img.onload = function(){
          ctx.drawImage(img, 0, 0);

        }
      </script>
      <script>
        // When true, moving the mouse draws on the canvas
        let isDrawing = false;
        let x = 0;
        let y = 0;
        const myPics = document.getElementById('myCanvas');
        const context = myPics.getContext('2d');
        
        myPics.addEventListener('mousedown', e => {
          x = e.offsetX;
          y = e.offsetY;
          isDrawing = true;
        });
        myPics.addEventListener('mousemove', e => {
          if (isDrawing === true) {
            drawLine(context, x, y, e.offsetX, e.offsetY);
            x = e.offsetX;
            y = e.offsetY;
          }
        });
        window.addEventListener('mouseup', e => {
          if (isDrawing === true) {
            drawLine(context, x, y, e.offsetX, e.offsetY);
            x = 0;
            y = 0;
            isDrawing = false;
          }
        });
        function drawLine(context, x1, y1, x2, y2) {
          context.beginPath();
          context.strokeStyle = 'orange';
          context.lineWidth = 4;
          context.moveTo(x1, y1);
          context.lineTo(x2, y2);
          context.stroke();
          context.closePath();
        }
        // creamos los eventos touchstart, touchmove y touchend
        canvas.addEventListener('touchstart',draw, false);
        canvas.addEventListener('touchmove',draw, false);
        canvas.addEventListener('touchend',draw, false);
        // prevent elastic scrolling
        document.body.addEventListener('touchmove',function(event){
            event.preventDefault();
        },false);
      </script>

      <script type="text/javascript"> 
        function limpiar() {
            context.clearRect(0, 0, canvas.width, canvas.height);
            setTimeout(limpiar2(),5000);
         }
         function limpiar2() {   
            var canvas = document.getElementById("myCanvas");
            var ctx = canvas.getContext("2d");
            var img = new Image();
            img.src = "{{asset('storage/imagenesserver/patron_de_distribucion.png')}}";
            ctx.drawImage(img, 0, 0);
            img.onload = function(){
            ctx.drawImage(img, 0, 0);
            }
          }
      </script>
       
       <div>
        <input type="button" class="btn btn-success" onClick="limpiar();"  value="Limpiar" />
        <input type="hidden" name="patron_distribucion" id="patron_distribucion">
        <!-- <input type="button" onClick="Pluss();" value="Data" /> -->
       </div> 
       
      </div>
      <br>
    </div>
   </div>
   
   </div>
  </div>
  <!-- FIN DE PATRON DE DISTRIBUCION -->

  <br>
   <br>
   <div align="center">
    <table class="table table-light">
      <thead class="table-success">
        <tr>
           <th class="w3-border" style="width:20%">Comentarios</th>    
        </tr>
      </thead>
      <tbody>
        <td class="w3-border" style="width:25%">
          <textarea style="width:100%" id="comentario_patron" name="comentario_patron" rows="2">
          </textarea>
        </td>  
      </tbody>
    </table>
   </div>
   <!-- GENITALES -->
   <div>
    <p>GENITALES:</p>
    <div align="center" id="div_macho" style="display:;">
    <table class="table table-light">
    <thead class="table-success">
    <tr>
       <th class="w3-border" style="width:20%">Macho</th>    
       <th class="w3-border" style="width:20%">Normales</th>  
       <th class="w3-border" style="width:60%">Comentarios</th> 
    </tr>
    </thead>
    <tbody>
    <tr>
       <td class="w3-border">Prepucio</td>
       <td class="w3-border">
         <div class="col" style="background-color:#FFFFFF;">
         <label>  
            Si: <input type='radio' name='radio_m' value='SI' id="g1">   
         </label>
         <label>  
            No: <input type='radio' name='radio_m' value='NO' id="g1">   
         </label>
         </div>
       </td>
       <td class="w3-border"><input type="textarea" id="g1_comentario" value="" style="width:100%"></td>
    </tr>
    <tr>
       <td class="w3-border">Escroto</td>
       <td class="w3-border">
         <div class="col" style="background-color:#FFFFFF;">
         <label>  
            Si: <input type='radio' name='radio_e' value='SI' id="g2">   
         </label>
         <label>  
            No: <input type='radio' name='radio_e' value='NO' id="g2">   
         </label>
         </div>
       </td>
       <td class="w3-border"><input type="textarea" id="g2_comentario" value="" style="width:100%"></td>
    </tr>
    <tr>
       <td class="w3-border">Pene</td>
       <td class="w3-border">
         <div class="col" style="background-color:#FFFFFF;">
         <label>  
            Si: <input type='radio' name='radio_i' value='SI' id="g3">   
         </label>
         <label>  
            No: <input type='radio' name='radio_i' value='NO' id="g3">   
         </label>
         </div>
       </td>
       <td class="w3-border"><input type="textarea" id="g3_comentario" value="" style="width:100%"></td>
    </tr>
  </tbody>
 </table>

</div>

<div align="center" id="div_hembra" style="display:;">
<table class="table table-light">
  <thead class="table-success">
    <tr>
       <th class="w3-border" style="width:20%">Hembra</th>    
       <th class="w3-border" style="width:20%">Normales</th>  
       <th class="w3-border" style="width:60%">Comentarios</th> 
    </tr>
  </thead>
  <tbody>
    <tr>
       <td class="w3-border">Vulva</td>
       <td class="w3-border">
         <div class="col" style="background-color:#FFFFFF;">
         <label>  
            Si: <input type='radio' name='radio_m' value='SI' id="g1">   
         </label>
         <label>  
            No: <input type='radio' name='radio_m' value='NO' id="g1">   
         </label>
         </div>
       </td>
       <td class="w3-border"><input type="textarea" id="g1_comentario" value="" style="width:100%"></td>
    </tr>
    <tr>
       <td class="w3-border">Vagina</td>
       <td class="w3-border">
         <div class="col" style="background-color:#FFFFFF;">
         <label>  
            Si: <input type='radio' name='radio_e' value='SI' id="g2">   
         </label>
         <label>  
            No: <input type='radio' name='radio_e' value='NO' id="g2">   
         </label>
         </div>
       </td>
       <td class="w3-border"><input type="textarea" id="g2_comentario" value="" style="width:100%"></td>
    </tr>
    <tr>
       <td class="w3-border">Glandulas mamarias</td>
       <td class="w3-border">
         <div class="col" style="background-color:#FFFFFF;">
         <label>  
            Si: <input type='radio' name='radio_i' value='SI' id="g3">   
         </label>
         <label>  
            No: <input type='radio' name='radio_i' value='NO' id="g3">   
         </label>
         </div>
       </td>
       <td class="w3-border"><input type="textarea" id="g3_comentario" value="" style="width:100%"></td>
    </tr>
  </tbody>
 </table>

</div>
    
   </div>
   

  </div>
  <!-- FIN DE EXAMEN FISICO -->
</div>
   <div class="w3-right" style="width:10%">
      <div class="">
        @foreach($mascota as $pet)
       <a href="{{url('/hoja_clinica/lista_problemas/'.$pet->cod_mascota.'/')}}" class="btn btn-process  w3-button w3-hover-yellow" ><img src="https://img.icons8.com/external-becris-lineal-becris/64/26e07f/external-next-mintab-for-ios-becris-lineal-becris.png"height="40">
       Siguiente</a>
      </div>
      @endforeach
      <br>
      <br>
   </div>


</body>

 

@endsection