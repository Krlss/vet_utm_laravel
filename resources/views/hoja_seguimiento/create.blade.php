@extends('layouts.admin')

@section('content')

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

     <div class="" style="width:10%">
      <div class="">
       <a href="{{url('/hoja_seguimiento/')}}" class="btn btn-process w3-button w3-hover-yellow" ><img src="https://img.icons8.com/pastel-glyph/64/26e07f/back.png" height="40">Atras</a>
      </div>
     </div>

<!DOCTYPE html>
<html>
<head>
<title>Laravel Dynamically Add or Remove input fields using JQuery - Tutsmake.com</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<style type="text/css">
body {
background-color: #edf2f7;
}
</style>
</head>
<body>
<div class="container mt-3">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card">
<div class="card-header">
<h2 class="text-success">Laravel Dynamically Add or Remove input fields using JQuery Demo - Tutsmake.com</h2>
</div>
<div class="card-body">
<div class="form-group">
<form name="add_name" id="add_name">  
<div class="alert alert-danger show-error-message" style="display:none">
<ul></ul>
</div>
<div class="alert alert-success show-success-message" style="display:none">
<ul></ul>
</div>
<div class="table-responsive">  
<table class="table table-bordered" id="dynamic_field"> 
<tr>  
<td><input type="text" name="title[]" placeholder="Enter title" class="form-control name_list" / id="title"></td>  
<td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
</tr>  
</table>  
<input type="button" name="submit" id="submit" class="btn btn-primary" value="Submit" />  
</div>
</form>  
</div> 
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){      
var url = "{{ url('add-remove-input-fields') }}";
var i=1;  
$('#add').click(function(){  
var title = $("#title").val();
i++;  
$('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="title[]" placeholder="Enter title" class="form-control name_list" value="'+title+'" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
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
</html> 

 

@endsection