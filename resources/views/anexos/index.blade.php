@extends('layouts.admin')

@section('content')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<style type="text/css">
	table{
    width:100%;
}
#example_filter{
    float:right;
}
#example_paginate{
    float:right;
}
label {
    display: inline-flex;
    margin-bottom: .5rem;
    margin-top: .5rem;
   
}
</style>
<script type="text/javascript">
	$(document).ready(function() {
    $('#example').DataTable(
        
         {     

      "aLengthMenu": [[1,5, 10, 25, -1], [1,5, 10, 25, "All"]],
        "iDisplayLength": 5
       } 
        );
} );


function checkAll(bx) {
  var cbs = document.getElementsByTagName('input');
  for(var i=0; i < cbs.length; i++) {
    if(cbs[i].type == 'checkbox') {
      cbs[i].checked = bx.checked;
    }
  }
}
</script>
<script type="text/javascript">
function exportF(elem) {
  var table = document.getElementById("example");
  var html = table.outerHTML;
  var url = 'data:application/vnd.ms-excel,' + escape(html); // Set your html table into url 
  elem.setAttribute("href", url);
  elem.setAttribute("download", "Anexo.xls"); // Choose the file name
  return false;
}
</script>

@if(Session::has('Mensaje'))

<div class="alert alert-success">
  <strong>{{Session::get('Mensaje')}}</strong> 
</div>
@endif

<div class="container">
      <div class="row justify-content-left">
        <div class="col-md-3">
            
   	    </div>

   	  </div>

   	  <br>
   	  

   	    <div class="col-md-12 text-right">
    	  <div class=" col-md-16 text-right">
    		<h7>Reportes:</h7><h7> </h7>
            	<a id="downloadLink" onclick="exportF(this)" class="btn btn-success"><i class="fa fa-table" ></i>Excel</a> 
		  </div> 
		</div>




    <div class="row justify-content-center">
        
        <div class="col-md-12">
            <div class="card">
		    <div style="overflow-x:auto;">      
		     <table class="table table-light table-striped table-bordered" id="example"  style="width:100%">
    <thead class="thead-light">
    <tr>    
      <th>Identificación</th> 
      <th>Nombre</th>  
      <th>F. Nacido</th>  
      <th>Sexo </th>
      <th>Especie</th>  
      <th>raza</th>
      <th>Acciones</th>
    </tr>

  </thead>

  <tbody>
    @foreach($hoja_clinica as $pet)
    <tr>
      
      <td>{{$pet->cod_mascota}}</td>
      <td>{{$pet->name}}</td> 
      <td>{{$pet->birth}}</td>
      <td>{{$pet->sex}}</td> 
      <td>{{$pet->specie}}</td>
      <td>{{$pet->race}}</td>
            <td>
                <div  class="btn-group">
                    <form  method="post" action="{{url('/anexos/'.$pet->cod_mascota)}}">
                    	<a title="Generar nuevo anexo" href="{{url('/anexos/create/'.$pet->cod_mascota)}}" class="btn btn-success"><i class="fa fa-book" aria-hidden="true"></i></a>
                        <a title="Listado de Anexos" href="{{url('/anexos/listado/'.$pet->cod_mascota)}}" class="btn btn-warning" target ="_blank"><i class="fa fa-book" ></i></a>
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
         
                    </form>

                </div>
                    
             </td>
    </tr>
    @endforeach
  </tbody>

</table>
		     </div>
            </div>

        </div>

            
    </div>
 	 
</div>

@endsection