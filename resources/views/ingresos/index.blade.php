@extends('layouts.admin')
@section('content')



  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">


<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="{{asset('storage/imagenesserver/vet.png')}}"class="w3-circle w3-margin-right" style="width:46px">
    </div>
    <div class="w3-col s8 w3-bar">
      <span>Bienvenido, <strong>{{Auth::user()->name}}</strong></span><br>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-cog"></i></a>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Opciones</h5>
  </div>
  <!-- Accordion -->
      <div class="w3-card w3-round">
        <div class="w3-white">
          <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-green w3-left-align"><i class="fa fa-sticky-note-o fa-fw w3-margin-right"></i>Hoja Clinica</button>
          <div id="Demo1" class="w3-hide w3-container">
            <a href="{{url('ingresos')}}" >
            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#reportes"><i class=" fa fa-cog "></i> Panel parametrizable</button>
            </a>
            <a href="{{url('hoja_clinica')}}" >
            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#reportes"><i class=" fa fa-cog "></i> Historia Clinica</button>
            </a>
            <br>
            <a href="{{url('hoja_seguimiento')}}" >
            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#reportes"><i class=" fa fa-cog "></i> Seguimiento</button>
            </a>
          </div>
          <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-green w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i> Reportes</button>
          <div id="Demo2" class="w3-hide w3-container">
            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#rtachos"><i class=" fa fa-file "></i> R. de Mascotas Registradas  </button>
           
            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#rdpro"><i class=" fa fa-file "></i> R. de Propietarios</button>
            
          </div>
         
        </div>      
      </div>
      <br>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-pencil-square-o"></i> Parametros General de Paciente</b></h5>
  </header>

    <div class="w3-row-padding w3-margin-bottom">
     <a href="{{url('ingreso_especie')}}" >
    <div class="w3-quarter">
      <div class="w3-container w3-leftbar w3-border-yellow w3-white w3-hover-green w3-text-green w3-padding-16">
        <div class="w3-left"><img src="https://img.icons8.com/color/48/000000/pets--v2.png"/></div>
        <div class="w3-right">
          <h3> </h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Especie</h4>
      </div>
    </div>
    </a>

     <a href="{{url('ingreso_raza')}}" >
    <div class="w3-quarter">
      <div class="w3-container w3-leftbar w3-border-yellow w3-white w3-hover-green w3-text-green w3-padding-16">
        <div class="w3-left"><img src="https://img.icons8.com/color-glass/50/000000/german-shepherd.png"/><img src="https://img.icons8.com/color-glass/50/000000/cat.png"/></div>
        <div class="w3-right">
          <h3> </h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Raza</h4>
      </div>
    </div>
    </a>

     <a href="{{url('ingresos')}}" >
     <div class="w3-quarter">
      <div class="w3-container w3-leftbar w3-border-yellow w3-white w3-hover-green w3-text-green w3-padding-16">
        <div class="w3-left"><img src="https://img.icons8.com/color/48/000000/groomig.png"/></div>
        <div class="w3-right">
          <h3> </h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Pelaje</h4>
      </div>
    </div>
    </a>

    <a href="{{url('ingresos')}}" >
    <div class="w3-quarter">
      <div class="w3-container w3-leftbar w3-border-yellow w3-white w3-hover-green w3-text-green w3-padding-16">
        <div class="w3-left"><img src="https://img.icons8.com/fluency/48/000000/features-list.png"/></i></div>
        <div class="w3-right">
        </div>
        <div class="w3-clear"></div>
        <h4>Características</h4>
      </div>
    </div>
    </a>

  </div>

    <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-pencil-square-o"></i> Parámetros de Exámen Físico</b></h5>
    </header>

    <div class="w3-row-padding w3-margin-bottom">
     <a href="{{url('deshidratacion')}}" >
    <div class="w3-quarter">
      <div class="w3-container w3-leftbar w3-border-yellow w3-white w3-hover-green w3-text-green w3-padding-16">
        <div class="w3-left"><img src="https://img.icons8.com/color/48/000000/dew-point.png"/></div>
        <div class="w3-right">
          <h3> </h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Tol. Deshidratación</h4>
      </div>
    </div>
    </a>
    

     <a href="{{url('ingreso_vacuna')}}" >
    <div class="w3-quarter">
      <div class="w3-container w3-leftbar w3-border-yellow w3-white w3-hover-green w3-text-green w3-padding-16">
        <div class="w3-left"><img src="https://img.icons8.com/plasticine/48/000000/syringe.png"/></div>
        <div class="w3-right">
          <h3> </h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Vacunas</h4>
      </div>
    </div>
    </a>

     <a href="{{url('linfonodos')}}" >
     <div class="w3-quarter">
      <div class="w3-container w3-leftbar w3-border-yellow w3-white w3-hover-green w3-text-green w3-padding-16">
        <div class="w3-left"><img src="https://img.icons8.com/color/48/000000/veterinarian.png"/></div>
        <div class="w3-right">
          <h3> </h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Linfonodos</h4>
      </div>
    </div>
    </a>

    <a href="{{url('patron_distribucion')}}" >
    <div class="w3-quarter">
      <div class="w3-container w3-leftbar w3-border-yellow w3-white w3-hover-green w3-text-green w3-padding-16">
        <div class="w3-left"><img src="https://img.icons8.com/color/48/000000/veterinary-examination.png"/></div>
        <div class="w3-right">
        </div>
        <div class="w3-clear"></div>
        <h4>Patron de distribución</h4>
      </div>
    </div>
    </a>

  </div>


     <header class="w3-container" style="padding-top:22px">
     <h5><b><i class="fa fa-pencil-square-o"></i> Parámetros de Problemas</b></h5>
     </header>

     <div class="w3-row-padding w3-margin-bottom">

      <a href="{{url('lista_problemas')}}" >
     <div class="w3-quarter">
      <div class="w3-container w3-leftbar w3-border-yellow w3-white w3-hover-green w3-text-green w3-padding-16">
        <div class="w3-left"><img src="https://img.icons8.com/color/48/000000/veterinarian.png"/></div>
        <div class="w3-right">
          <h3> </h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Lista de Problema</h4>
      </div>
    </div>
    </a>

    <a href="{{url('ing_lista_maestra')}}" >
    <div class="w3-quarter">
      <div class="w3-container w3-leftbar w3-border-yellow w3-white w3-hover-green w3-text-green w3-padding-16">
        <div class="w3-left"><img src="https://img.icons8.com/color/48/000000/medical-heart.png"/><img src="https://img.icons8.com/color/48/000000/lungs.png"/><img src="https://img.icons8.com/color/48/000000/kidney.png"/></div>
        <div class="w3-right">
        </div>
        <div class="w3-clear"></div>
        <h4>L. Maestra(SISTEMAS)</h4>
      </div>
    </div>
    </a>
     </div>


  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">
    <h4>ClinicVet</h4>
    <p>Desarrollado por: Frank Molina & Miguel Valdiviezo 
  </footer>

  <!-- End page content -->
</div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>

<script>
// Accordion
function myFunction(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-theme-d1";
  } else { 
    x.className = x.className.replace("w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-theme-d1", "");
  }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>

</body>
</html>
@endsection

