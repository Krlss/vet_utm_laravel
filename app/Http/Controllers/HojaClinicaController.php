<?php

namespace App\Http\Controllers;

use App\hoja_clinica;
use App\linfonodo;
use App\especie;
use App\deshidratacion;
use App\desparasitante;
use App\mucosas;
use App\registro_mascota;
use App\sistemas;
use App\lista_problema;
use App\plan_terapeutico;
use App\examen_fisico;
use App\lista_maestra;



use Illuminate\Http\Request;

class HojaClinicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['hoja_clinica']=registro_mascota::all();
        return view('hoja_clinica.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($pet_id)
    {
         $deshidratacion =deshidratacion::all();
         $mucosas =mucosas::all();
         $especie =especie::all();
         $desparasitante=desparasitante::all();
         $mascota=registro_mascota::all()->where('cod_mascota',$pet_id);
         return view('hoja_clinica.create',compact('deshidratacion','mucosas','mascota','especie','desparasitante'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $hoja_clinica=request()->except('_token');
        hoja_clinica::insert($hoja_clinica);
        return redirect('examen_fisico/create/'.$request->cod_mascota)->with('Mensaje','Datos generales ingresados con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\hoja_clinica  $hoja_clinica
     * @return \Illuminate\Http\Response
     */
    public function show($pet_id)
    {
        $hoja_clinica = hoja_clinica::all()->where('cod_mascota' , $pet_id);
        $registro_mascota = registro_mascota::all()->where('cod_mascota' , $pet_id);
        $examen_fisico = examen_fisico::all()->where('cod_mascota' , $pet_id);
        $lista_maestra = lista_maestra::all()->where('cod_mascota' , $pet_id);
        $plan_terapeutico = plan_terapeutico::all()->where('cod_mascota' , $pet_id);

        
        $view = view('hoja_clinica.show',compact('hoja_clinica','registro_mascota','examen_fisico','lista_maestra','plan_terapeutico'));
        $pdf = \App::make ('dompdf.wrapper');
        $pdf -> loadHTML($view);
        return $pdf->stream('hoja_clinica','registro_mascota','examen_fisico','lista_maestra','plan_terapeutico');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\hoja_clinica  $hoja_clinica
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('hoja_clinica.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\hoja_clinica  $hoja_clinica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, hoja_clinica $hoja_clinica)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\hoja_clinica  $hoja_clinica
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eliminar= hoja_clinica::findOrFail($id);
        hoja_clinica::destroy($id);
        return redirect('hoja_clinica')->with('Mensaje','Datos Eliminados con exito.');
    }


/*
     public function listado_historia()
    {
    
    }*/


    public function examen_fisico($pet_id)
    {
         $deshidratacion =deshidratacion::all();
         $mucosas =mucosas::all();
         $hoja_clinica = hoja_clinica::all()->where('cod_mascota',$pet_id);
         $mascota=registro_mascota::all()->where('cod_mascota',$pet_id);
         return view('hoja_clinica.examen_fisico',compact('deshidratacion','mucosas','mascota','hoja_clinica'));
    }

     public function lista_problemas($pet_id)
    {
         $deshidratacion =deshidratacion::all();
         $mucosas =mucosas::all();
         $lista_maestra=sistemas::all();
         $mascota=registro_mascota::all()->where('cod_mascota',$pet_id);
         return view('hoja_clinica.lista_problemas',compact('deshidratacion','mucosas','mascota','lista_maestra'));
    }

     public function plan_terapeutico($pet_id)
    {
         $deshidratacion =deshidratacion::all();
         $plan_terapeutico = plan_terapeutico::all();
         $lista_maestra=sistemas::all();
         $mascota=registro_mascota::all()->where('cod_mascota',$pet_id);
         return view('hoja_clinica.plan_terapeutico',compact('deshidratacion','mascota'));
    }
    
}
