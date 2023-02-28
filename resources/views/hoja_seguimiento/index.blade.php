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
   function exportF(elem) {
     var table = document.getElementById("example");
     var html = table.outerHTML;
     var url = 'data:application/vnd.ms-excel,' + escape(html); // Set your html table into url 
     elem.setAttribute("href", url);
     elem.setAttribute("download", "Gramajes.xls"); // Choose the file name
     return false;
   }
   
   $(document).ready(function () {
       // Setup - add a text input to each footer cell
       $('#example thead tr')
           .clone(true)
           .addClass('filters')
           .appendTo('#example thead');
    
       var table = $('#example').DataTable({
           
           orderCellsTop: true,
           fixedHeader: true,
           initComplete: function () {
               var api = this.api();
    
               // For each column
               api
                   .columns()//1,4 va desde la columna 1 hasta la 4 
                   .eq(0)
                   .each(function (colIdx) {
                       // Set the header cell to contain the input element
                       var cell = $('.filters th').eq(
                           $(api.column(colIdx).header()).index()
                       );
                       var title = $(cell).text();
                       $(cell).html('<input type="input" class="form-control" required autocomplete=" " autofocus onkeyup=" var start = this.selectionStart; var end = this.selectionEnd;  this.value = this.value.toUpperCase();  this.setSelectionRange(start, end);"/>');
                         
                       // On every keypress in this input
                       $(
                           'input',
                           $('.filters th').eq($(api.column(colIdx).header()).index())
                       )
                           .off('keyup change')
                           .on('keyup change', function (e) {
                               e.stopPropagation();
    
                               // Get the search value
                               $(this).attr('title', $(this).val());
                               var regexr = '({search})'; //$(this).parents('th').find('select').val();
    
                               var cursorPosition = this.selectionStart;
                               // Search the column for that value
                               api
                                   .column(colIdx)
                                   .search(
                                       this.value != ''
                                           ? regexr.replace('{search}', '(((' + this.value + ')))')
                                           : '',
                                       this.value != '',
                                       this.value == ''
                                   )
                                   .draw();
    
                               $(this)
                                   .focus()[0]
                                   .setSelectionRange(cursorPosition, cursorPosition);
                           });
                   });
           },
       });
   });
</script>
@if(Session::has('Mensaje'))
<div class="alert alert-success">
  <strong>{{Session::get('Mensaje')}}</strong> 
</div>
@endif

<div class="container">

      <div class="col">    
        <h4>Seguimiento de Pacientes</h4>
      </div>

    <div class="col-md-12 text-right">
        <div class="col-md-16 text-right">
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
      <th>#</th>    
      <th>Id_mascota</th> 
      <th>Fecha</th>  
      <th>Horario</th>  
      <th>Jul General </th>
      <th>Jul Interno</th>  
      <th>Supervisor</th>
      <th>Operador</th>
      <th>Producción</th>
      <th>T / C</th>
      <th>Grupo</th>
      <th>matadero</th>
      <th>Cuchillo</th>
      <th>Chifa si/no</th>
      <th>Acciones</th>
    </tr>

  </thead>

  <tbody>
    @foreach($hoja_seguimiento as $encabezado)
    <tr>
      <td>{{$loop->iteration}}</td>
        <td>{{$encabezado->codigo_encabezado}}</td>
      <td>{{$encabezado->fecha_tacho}}</td> 
      <td>{{$encabezado->horario_inicio}} - {{$encabezado->horario_fin}}</td> 
      <td>{{$encabezado->juliano_general}}</td> 
      <td>{{$encabezado->juliano_interno}}</td> 
      <td>{{$encabezado->supervisor}}</td>
      <td>{{$encabezado->operador_tacho}}</td>
      <td>{{$encabezado->tipo_tacho}}</td>        //modificar a variables 
      <td>{{$encabezado->tacho_caja}}</td>
      <td>{{$encabezado->grupo_trabajo}}</td> 
      <td>{{$encabezado->freidora}}</td>
      <td>{{$encabezado->codigo_equipo}}</td> 
      <td>{{$encabezado->codigo_producto}}</td>
       <td>
        <div  class="btn-group">
          <a href="{{url('/hoja_seguimiento/edit/'.$encabezado->id.'')}}" class="btn btn-warning"><i class="fa fa-pencil" ></i></a>
          
          <form method="post" action="{{url('/hoja_seguimiento/'.$encabezado->id.'')}}">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Seguro deseas eliminar el dato?')"><i class="fa fa-trash" ></i></button>
          </form>
        </div>
            <a href="{{url('/hoja_seguimiento/create/'.$encabezado->id.'/'.$encabezado->codigo_encabezado.'')}}" class="btn btn-success"> -Segui- </a>
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