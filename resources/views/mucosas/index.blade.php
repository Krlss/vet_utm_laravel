@extends('layouts.admin')
@section('content')


@if(Session::has('Mensaje'))
<div class="alert alert-success">
  <strong>{{Session::get('Mensaje')}}</strong> 
</div>
@endif

<div class="container">
      <div class="row justify-content-left">
        <div class="col-md-3">
            <div class="card">
            	
			<a href="{{url('/mucosas/index')}}" class="btn btn-success" >Agregar nuevo Parámetro</a>

            </div>
   	    </div>

   	  </div>

   	  <br>
   	  
  {!! Form::select('sistema',$sistemas,null,['id'=>'nom_sistema']) !!}

  {!! Form::select('problema',['placeholder'=>'Selecciona'],null,['id'=>'nom_problema']) !!}

 	 
</div>

<script type="text/javascript">
	$("#sistema").change(function(event){
		$.get("problema/"+event.target.value.replace("{}","")+"",function(response,sistema){
 			console.log(response);
		});
	});
</script>

@endsection