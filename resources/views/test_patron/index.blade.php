<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <title>Firma remota</title> 

    <link href="style.css" type="text/css" rel="stylesheet">
</head>
<body>
<script type="text/javascript">
function Pluss(){   
  var canvas = document.getElementById('sketchpad');
var canvasData = canvas.toDataURL("image/png");
document.getElementById("Imagen").value = canvasData;
console.log(canvasData);
}
</script>

</script>
<h3>Firma</h3>
<div id="container">
    <canvas id="sketchpad" width="320" height="270" style="border:1px solid #d3d3d3;">Error no soportado</canvas>

    <script type="text/javascript">
        function limpiar() {
        context.clearRect(0, 0, canvas.width, canvas.height);
        }       
      </script>
    <script>
        // When true, moving the mouse draws on the canvas
        let isDrawing = false;
        let x = 0;
        let y = 0;

        const myPics = document.getElementById('sketchpad');
        const context = myPics.getContext('2d');

        // event.offsetX, event.offsetY gives the (x,y) offset from the edge of the canvas.

        // Add the event listeners for mousedown, mousemove, and mouseup
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

      

    <div id="respuesta"></div>

    <div>
        <label>Numero:</label>
        <input type="text" name="Numero" id="Numero" onkeyup="this.value = this.value.toUpperCase();">
    </div>
    <div>
        <label>Nombre:</label>
        <input type="text" name="Nombre" id="Nombre" onkeyup="this.value = this.value.toUpperCase();">
    </div>
    <div>
        <label>Imagen:</label>
        <input type="text" name="Imagen" id="Imagen">
    </div>

    <div>
        <input type="button" onClick="salvarDatos();" value="Guardar datos" />
        <input type="button" onClick="Pluss();" value="Limpiar firma" />
    </div>
</div>

</body>
</html>

<script type="text/javascript">
    


function salvarDatos() {
    var respuesta=document.getElementById("respuesta");
    respuesta.innerHTML="";
    respuesta.classList.remove("ok","ko");

    var canvasData = canvas.toDataURL("image/png");
    document.getElementById("Imagen").value = canvasData;

    nombre = document.getElementById('nombre').value;
    numero = document.getElementById('numero').value;

    var data=new FormData();
    data.append("img",canvasData);
    data.append("nombre",nombre);
    data.append("numero",numero);

    // Enviamos por ajax la imagen y los valores del formulario
    var ajax = new XMLHttpRequest();       
    ajax.open("POST", "guardar.php",true);
    ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {
            var myArr = JSON.parse(ajax.responseText);
            respuesta.innerHTML = myArr[1];
            if(myArr[0]==1)
            {
                respuesta.classList.add("ok");
            }else{
                respuesta.classList.add("ko");
            }
        }
    }
    ajax.send(data)
}

</script>
