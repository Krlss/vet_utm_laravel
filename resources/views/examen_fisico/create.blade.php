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
document.getElementById("patron_distribucion").value = canvasData;
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
<form action="{{url('/examen_fisico/')}}" method="post" enctype="multipart/form-data">
{{csrf_field()}}
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
                  <label for="errores" class="col-md-12 col-form-label text-md-left" >
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

<div align="center">
     
 <table class="table table-light">
    @foreach($hoja_clinica as $hoja)

      <thead class="table">
      <div class="row"> 
       <div class="col row w3-border">
       <div class="col" style="text-align:right; background-color:#FFFFFF;">Fecha:</div>
       <div class="col" style="background-color:#FFFFFF;">
       <input class="form-control w3-center" type="text" id="fecha_consulta" name="fecha_consulta"value="{{$hoja->fecha_consulta}}" readonly></div>
       </div>

       <div class="col row w3-border">
       <div class="col" style="text-align:right; background-color:#FFFFFF;" ># H. Clínica:</div>
       <div class="col" style="background-color:#FFFFFF;"><input class="form-control w3-center" type="text" name="cod_mascota" id="cod_mascota" value="{{$hoja->cod_mascota}}" readonly></div>
       </div>
      </div>
       
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
       <td class="w3-border" style="width:25%">Peso(KG): <input type="number" name="peso" id="peso" style="width:40%; text-align:center;"></td>    
       <td class="w3-border" style="width:25%">Temperatura(ºC): <input type="number" name="temperatura" id="temperatura" style="width:40%; text-align:center;" ></td>  
       <td class="w3-border" style="width:50%">
         <div class="col" style="background-color:#FFFFFF;">
         <label>  
            Deshidratación:   Si:<input type='radio' name='deshidratacion' value='SI' id="deshidratacion">   
         </label>
         <label>  
            No:<input type='radio' name='deshidratacion' value='NO' id="deshidratacion">   
         </label>
         <label></label>
         <label>  
            <select name="porciento_deshidratacion"  id="porciento_deshidratacion">
                    <option disabled selected hidden>Porciento...</option>
                    @foreach($deshidratacion as $des)
                    <option>{{$des->porcentaje}}%</option>
                    @endforeach
                  </select>   
         </label>
         </div>
       </td> 
    </tr>
    <tr>
       <td class="w3-border" style="width:25%">F. Respiratoria:<input type="number" name="frec_respiratoria" id="frec_respiratoria" style="width:30%; text-align:center;" > rpm. </td>    
       <td class="w3-border" style="width:25%">F. Cardiaca:<input type="number" name="frec_cardiaca" id="frec_cardiaca" style="width:40%; text-align:center;" > lpm. </td>  
       <td class="w3-border" style="width:50%">T.LL.C.<input type="number" name="tllc" id="tllc" style="width:40%; text-align:center;" > Seg. </td> 
    </tr>

    <tr>
       <td class="w3-border" style="width:25%">Otros: <input type="text" name="otros" id="otros" style="width:70%; text-align:left;" ></td>    
       <td class="w3-border" style="width:25%"></td>  
       <td class="w3-border" style="width:50%">
         <div class="col" style="background-color:#FFFFFF;">
         <label>  
            Mucosas:  <select name="mucosas"  id="mucosas">
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
            Si: <input type='radio' name='lm' value='SI' id="lm">   
         </label>
         <label>  
            No: <input type='radio' name='lm' value='NO' id="lm">   
         </label>
         </div>
       </td>
       <td class="w3-border"><input class="form-control" type="textarea" name="lm_comentario" id="lm_comentario" style="width:100%"></td>
    </tr>
    <tr>
       <td class="w3-border">Escapulares</td>
       <td class="w3-border">
         <div class="col" style="background-color:#FFFFFF;">
         <label>  
            Si: <input type='radio' name='le' id="le" value='SI' >   
         </label>
         <label>  
            No: <input type='radio' name='le' id="le" value='NO' >   
         </label>
         </div>
       </td>
       <td class="w3-border"><input class="form-control" type="textarea" name="le_comentario" id="le_comentario" style="width:100%"></td>
    </tr>
    <tr>
       <td class="w3-border">Inguinales</td>
       <td class="w3-border">
         <div class="col" style="background-color:#FFFFFF;">
         <label>  
            Si: <input type='radio' name='li' value='SI' id="li">   
         </label>
         <label>  
            No: <input type='radio' name='li' value='NO' id="li">   
         </label>
         </div>
       </td>
       <td class="w3-border"><input class="form-control" type="textarea" name="li_comentario" id="li_comentario" style="width:100%"></td>
    </tr>
    <tr>
       <td class="w3-border">Poplíteos</td>
       <td class="w3-border">
         <div class="col" style="background-color:#FFFFFF;">
         <label>  
            Si: <input type='radio' name='lp' value='SI' id="lp">   
         </label>
         <label>  
            No: <input type='radio' name='lp' value='NO' id="lp">   
         </label>
         </div>
       </td>
       <td class="w3-border"><input class="form-control" type="textarea" name="lp_comentario" id="lp_comentario" style="width:100%"></td>
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
        // Dibujo en el lienzo
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
        @foreach($mascota as $pet)
        <input  type="text" style="width:70%; text-align:center;" id="sexo" hidden="true" value="{{$pet->sex}}" >
        @endforeach
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
          <textarea class="form-control" style="width:100%" id="comentario_patron" name="comentario_patron" rows="2"></textarea>
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
            Si: <input type='radio' name='g1' value='SI' id="g1" onclick='Pluss()'>   
         </label>
         <label>  
            No: <input type='radio' name='g1' value='NO' id="g1" onclick='Pluss()'>   
         </label>
         </div>
       </td>
       <td class="w3-border"><input class="form-control" type="textarea" name="g4_comentario" id="g4_comentario" style="width:100%"></td>
    </tr>
    <tr>
       <td class="w3-border">Escroto</td>
       <td class="w3-border">
         <div class="col" style="background-color:#FFFFFF;">
         <label>  
            Si: <input type='radio' name='g2' value='SI' id="g2" onclick='Pluss()'>   
         </label>
         <label>  
            No: <input type='radio' name='g2' value='NO' id="g2" onclick='Pluss()'>   
         </label>
         </div>
       </td>
       <td class="w3-border"><input class="form-control" type="textarea" name="g5_comentario" id="g5_comentario" value="" style="width:100%"></td>
    </tr>
    <tr>
       <td class="w3-border">Pene</td>
       <td class="w3-border">
         <div class="col" style="background-color:#FFFFFF;">
         <label>  
            Si: <input type='radio' name='g3' value='SI' id="g3" onclick='Pluss()'>   
         </label>
         <label>  
            No: <input type='radio' name='g3' value='NO' id="g3" onclick='Pluss()'>   
         </label>
         </div>
       </td>
       <td class="w3-border"><input class="form-control" type="textarea" name="g6_comentario" id="g6_comentario" style="width:100%"></td>
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
            Si: <input type='radio' name='g1' value='SI' id="g1" onclick='Pluss()'>   
         </label>
         <label>  
            No: <input type='radio' name='g1' value='NO' id="g1" onclick='Pluss()'>   
         </label>
         </div>
       </td>
       <td class="w3-border"><input class="form-control" type="textarea" name="g1_comentario" id="g1_comentario" style="width:100%"></td>
    </tr>
    <tr>
       <td class="w3-border">Vagina</td>
       <td class="w3-border">
         <div class="col" style="background-color:#FFFFFF;">
         <label>  
            Si: <input type='radio' name='g2' value='SI' id="g2" onclick='Pluss()'>   
         </label>
         <label>  
            No: <input type='radio' name='g2' value='NO' id="g2" onclick='Pluss()'>   
         </label>
         </div>
       </td>
       <td class="w3-border"><input class="form-control" type="textarea" name="g2_comentario" id="g2_comentario" style="width:100%"></td>
    </tr>
    <tr>
       <td class="w3-border">Glandulas mamarias</td>
       <td class="w3-border">
         <div class="col" style="background-color:#FFFFFF;">
         <label>  
            Si: <input type='radio' name='g3' value='SI' id="g3" onclick='Pluss()'>   
         </label>
         <label>  
            No: <input type='radio' name='g3' value='NO' id="g3" onclick='Pluss()'>   
         </label>
         </div>
       </td>
       <td class="w3-border"><input class="form-control" type="textarea" name="g3_comentario" id="g3_comentario" style="width:100%"></td>
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
       
       <input type="submit" class="btn btn-success" onclick="Pluss()" value="Agregar">
       <!--<a href="{{url('/lista_maestra/create/'.$pet->cod_mascota.'/')}}" class="btn btn-process  w3-button w3-hover-yellow" ><img src="https://img.icons8.com/external-becris-lineal-becris/64/26e07f/external-next-mintab-for-ios-becris-lineal-becris.png" height="40">
       Siguiente</a>-->
      </div>
   
      <br>
      <br>
   </div>

</form>
</body>

 

@endsection