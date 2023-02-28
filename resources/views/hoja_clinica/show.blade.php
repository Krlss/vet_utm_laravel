

<!DOCTYPE html>
<html lang="en">
<head>
 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>


/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 10%;
  border-radius: 50%;
}

</style>
<style type="text/css">
	#contenidoTabla {
  font-size: 5px;
}

td {
	text-align: center;
  font-size: 10px;
  color: black;
}

th {
	text-align: center;
  font-size: 11px;
  color:black;
}


</style>

</head>

<body >

<div align="center" >
<table  class="table"  >
	
	<thead>
		<tr><th><img src="{{asset('storage/imagenesserver/vet.png')}}" alt="Avatar" class="avatar"></th></tr>
		<tr>
		   <td><h7>Universidad Tecnica de Manabi</h7></td><br>
		</tr>
		<tr>
			<td><h7>Facultad de Medicina Veterinaria</h7></td>
		</tr>
		<tr>
			<td><h7>Clínica Veterinaria "Dr. Gabriel Manzo Quiñonez"</h7></td>
		</tr>
	</thead>

 </table>

</div> 

<div>Generales:
     
    <table class="table">
     <tr>
     	@foreach($hoja_clinica as $hoja)
     	 <td></td>
     	 <td></td>
     	 <td></td>
     	 <td></td>
     	 <td></td>
		   <td style="text-align: right">Fecha:</td>	
		   <th style="text-align: left">{{$hoja->fecha_consulta}}</th>
		</tr>
		</table> 
</div>
@foreach($registro_mascota as $pet)
<div align="center" >
<table   class="table table-striped" >
	<thead>
		<tr>
		   <th style="text-align: left">I.D</th>		
		   <td>{{$pet->cod_mascota}}</td>	
		   <th style="text-align: left">Nombre</th>	
		   <td>{{$pet->name}}</td>
		   <th style="text-align: left">sexo</th>	
		   <td>{{$pet->sex}}</td>
		   <th style="text-align: left">Fecha Nac.</th>	
		   <td>{{$pet->birth}}</td>
		</tr>

		<tr>
		   <th style="text-align: left">Especie</th>	
		   <td>{{$pet->specie}}</td>
		   <th style="text-align: left">Raza</th>		
		   <td>{{$pet->race}}</td>
		   <th style="text-align: left">Castrado</th>	
		   <td>{{$pet->castrated}}</td>
		   <th style="text-align: left">I.D Padre</th>	
		   <td>{{$pet->id_pet_pather}}</td>
		</tr>
@endforeach

		<tr>
		   <th style="text-align: left">Alimentacion</th>		
		   <td>{{$hoja->alimentacion}}</td>	
		   <th style="text-align: left">Habitad</th>	
		   <td>{{$hoja->habitad}}</td>
		   <th style="text-align: left">Sombra</th>		
		   <td>{{$hoja->sombra}}</td>
		   <th style="text-align: left">Concreto</th>	
		   <td>{{$hoja->concreto}}</td>
		   
		</tr>

		<tr>
		   <th style="text-align: left">O. Animales</th>	
		   <td>{{$hoja->otro_especie}}({{$hoja->otro_cantidad}})</td>
		   <th style="text-align: left">Acc. Salir</th>	
		   <td>{{$hoja->salir}}</td>
		   <th style="text-align: left">Paseos</th>		
		   <td>{{$hoja->paseos}}</td>
		   <th style="text-align: left">Frecuencia</th>	
		   <td>{{$hoja->frec_paseos}} por Semana</td>
		</tr>

		<tr>
			 <th style="text-align: left">Monta</th>
		   <td>{{$hoja->monta}}</td>
		   <th style="text-align: left">Fecha</th>
		   <td>{{$hoja->fecha_monta}}</td>
		   <th style="text-align: left">Desparasitado</th>
		   <td>{{$hoja->desparasitacion}}</td>
		   <th style="text-align: left">Desparasitante</th>
		   <td>{{$hoja->nom_desparasitante}}</td>
		</tr>

	</thead>

 </table>

</div> 


<div>Exámen físico:</div>
@foreach($examen_fisico as $exa)
<div>
	<table class="table table-striped">
		
		<tr>
		   <th style="text-align: left">Peso</th>		
		   <td>{{$exa->peso}}</td>	
		   <th style="text-align: left">Temperatura</th>	
		   <td>{{$exa->temperatura}}</td>
		   <th style="text-align: left">Frec. Resp</th>	
		   <td>{{$exa->frec_respiratoria}}</td>
		   <th style="text-align: left">Frec. Cardiaca</th>	
		   <td>{{$exa->frec_cardiaca}}</td>
		</tr>

		<tr>
		   <th style="text-align: left">T.LL.C</th>	
		   <td>{{$exa->tllc}}</td>
		   <th style="text-align: left">Deshidratacion</th>		
		   <td>{{$exa->deshidratacion}}</td>
		   <th >%</th>	
		   <td>{{$exa->porciento_deshidratacion}}</td>
		   <th style="text-align: left">Mucosas</th>	
		   <td>{{$exa->mucosas}}</td>
		</tr>
@endforeach

		
	
  @foreach($examen_fisico as $exa)
	
		<th style="text-align: left">Otros</th>	
		<td>{{$exa->otros}}</td>
	</table>
	<br>


  </div>

  <div>

	<table class="table table-striped">
		<thead class="table-success">
    <tr class="w3-left-align">
       <th class="w3-border w3-left-align" style="width:20%; text-align: left">Linfonodos</th>    
       <th class="w3-border w3-left-align" style="width:20%; text-align: left">Normales</th>  
       <th class="w3-border w3-left-align" style="width:60%; text-align: left">Comentarios</th> 
    </tr>
  </thead>

	  <tr>
		   <th style="text-align: left">Mandibulares</th>		
		   <td style="text-align: left">{{$exa->lm}}</td>		
		   <td style="text-align: left">{{$exa->lm_comentario}}</td>
		</tr>
		<tr>
		   <th style="text-align: left">Escapulares</th>		
		   <td style="text-align: left">{{$exa->le}}</td>		
		   <td style="text-align: left">{{$exa->le_comentario}}</td>
		</tr>
		<tr>
		   <th style="text-align: left">Inguinales</th>		
		   <td style="text-align: left">{{$exa->li}}</td>	
		   <td style="text-align: left">{{$exa->li_comentario}}</td>
		</tr>
		<tr>
		   <th style="text-align: left">Poplíteos</th>		
		   <td style="text-align: left">{{$exa->lp}}</td>		
		   <td style="text-align: left">{{$exa->lp_comentario}}</td>
		</tr>
	  @endforeach
  @endforeach
  <br>
  <div>Inspección Física</div>
 </table>
</div>
<br>

<div>
<table>

  					@foreach($examen_fisico as $exa)
  					<img style="text-align: center" id="preview" src="{{$exa->patron_distribucion}}" class="img-responsive">
  					@endforeach
  			  <br>    
</table>

<table>
              <tr>
		      <th style="text-align: left">Comentario:</th>		
		      <td style="text-align: left">{{$exa->comentario_patron}}</td>
		      </tr>
		      
		      <thead>
	          <th>GENITALES:</th>
	          </thead>
		      <br>
</table>

<table class="table table-striped">
        @foreach($registro_mascota as $pet)
		   @foreach($examen_fisico as $exa)  
       	  @if($pet->sex == 'HEMBRA')
        
	    
		<thead class="table-success">
		     
       		<tr class="w3-left-align">
       		<th class="w3-border w3-left-align" style="width:20%; text-align: left">Hembra</th>    
       		<th class="w3-border w3-left-align" style="width:20%; text-align: left">Normales</th>  
            <th class="w3-border w3-left-align" style="width:60%; text-align: left">Comentarios</th> 
            </tr>
 		</thead>
           <tr>
		   <th style="text-align: left">Vulva</th>		
		   <td style="text-align: left">{{$exa->g1}}</td>		
		   <td style="text-align: left">{{$exa->g1_comentario}}</td>
		   </tr>
		   <tr>
		   <th style="text-align: left">Vagina</th>		
		   <td style="text-align: left">{{$exa->g2}}</td>		
		   <td style="text-align: left">{{$exa->g2_comentario}}</td>
		   </tr>
		   <tr>
		   <th style="text-align: left">Glandulas mamarias</th>		
		   <td style="text-align: left">{{$exa->g3}}</td>	
		   <td style="text-align: left">{{$exa->g3_comentario}}</td>
		   </tr>
       		@else
       	
       		<thead class="table-success">
            <tr class="w3-left-align">
       		<th class="w3-border w3-left-align" style="width:20%; text-align: left">Macho</th>    
       		<th class="w3-border w3-left-align" style="width:20%; text-align: left">Normales</th>  
            <th class="w3-border w3-left-align" style="width:60%; text-align: left">Comentarios</th> 
            </tr>
            </thead>
           <tr>
		   <th style="text-align: left">Prepucio</th>		
		   <td style="text-align: left">{{$exa->g1}}</td>		
		   <td style="text-align: left">{{$exa->g4_comentario}}</td>
		   </tr>
		   <tr>
		   <th style="text-align: left">Escroto</th>		
		   <td style="text-align: left">{{$exa->g2}}</td>		
		   <td style="text-align: left">{{$exa->g5_comentario}}</td>
		   </tr>
		   <tr>
		   <th style="text-align: left">Pene</th>		
		   <td style="text-align: left">{{$exa->g3}}</td>	
		   <td style="text-align: left">{{$exa->g6_comentario}}</td>
		   </tr>
       		@endif
       		@endforeach
        	@endforeach
        	<br>
        	<div>Lista de Problemas:</div>
         
</table>

<table class="table table-striped">
	
		  <thead class="table-success">
           <tr class="w3-left-align">
       	   <th class="w3-border w3-left-align" style="width:20%; text-align: left">Problemas</th>    
       	   <th class="w3-border w3-left-align" style="width:40%; text-align: left">Lista Maestra</th>  
           <th class="w3-border w3-left-align" style="width:40%; text-align: left">Diagnostico Diferencial</th>
           </tr>
          </thead>
          @foreach($lista_maestra as $lista)
          <tr>
		   <td style="text-align: left">{{$lista->problema}}</td>		
		   <td style="text-align: left">{{$lista->sistema}}</td>		
		   <td style="text-align: left">{{$lista->diagnostico_diferencial}}</td>
		  </tr>
		  @endforeach
		  <br>
          <div>Plan Terapéutico:</div>
</table>

<table class="table table-striped">
	
		  <thead class="table-success">
           <tr class="w3-left-align">
       	   <th class="w3-border w3-left-align" style=" text-align: left">T. Terapia</th>    
       	   <th class="w3-border w3-left-align" style=" text-align: left">P. Activo</th>  
           <th class="w3-border w3-left-align" style=" text-align: left">Presentación</th>
           <th class="w3-border w3-left-align" style=" text-align: left">Presentación</th>
           <th class="w3-border w3-left-align" style=" text-align: left">Cant/Hora</th>  
           <th class="w3-border w3-left-align" style=" text-align: left">Dosis</th>
           <th class="w3-border w3-left-align" style=" text-align: left">Via</th>
           <th class="w3-border w3-left-align" style=" text-align: left">Frecuencia</th>
           </tr>
          </thead>
          @foreach($plan_terapeutico as $plan)
          <tr>
		   <td style="text-align: left">{{$plan->tipo_terapia}}</td>		
		   <td style="text-align: left">{{$plan->principio_activo}}</td>		
		   <td style="text-align: left">{{$plan->presentacion}}</td>
		   <td style="text-align: left">{{$plan->medicamento}}</td>
		   <td style="text-align: left">{{$plan->dosis_cant}}/{{$plan->dosis_tiempo}}</td>		
		   <td style="text-align: left">{{$plan->dosis_administra}}</td>		
		   <td style="text-align: left">{{$plan->via}}</td>
		   <td style="text-align: left">{{$plan->frec_duracion}}</td>
		  </tr>
		  @endforeach
		  <br>

</table>

</div>




</body>
</html>
                

    <script type="text/javascript">
           // Convert Base64 to Image
           window.onload = function() {
            
                //alert($("#response").val());
                document.getElementById('preview').setAttribute('src', $("#response").val());
                $("#preview").show();
            
        }
            
    </script>