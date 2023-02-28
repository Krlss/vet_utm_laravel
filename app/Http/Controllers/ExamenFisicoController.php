<?php

namespace App\Http\Controllers;

use App\examen_fisico;
use App\hoja_clinica;
use App\linfonodo;
use App\especie;
use App\deshidratacion;
use App\mucosas;
use App\registro_mascota;
use App\sistemas;
use App\lista_problema;
use App\plan_terapeutico;
use Illuminate\Http\Request;

class ExamenFisicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($pet_id)
    {
         $deshidratacion =deshidratacion::all();
         $mascota=registro_mascota::all()->where('cod_mascota',$pet_id);
         $hoja_clinica=hoja_clinica::all()->where('cod_mascota',$pet_id);
         $mucosas=mucosas::all();
         return view('examen_fisico.create',compact('deshidratacion','mascota','hoja_clinica','mucosas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
        $cod_mascota=$request->cod_mascota;
        //dd($request);
        $examen_fisico=request()->except('_token');
        examen_fisico::insert($examen_fisico);
        return redirect('lista_maestra/create/'.$request->cod_mascota)->with('Mensaje','Datos ingresados con exito.');


        /*
        if($request->sexo=='MACHO'){
            foreach($cod_mascota as $id){

                        $ids=new ExamenFisicoController();
                        $ids->cod_mascota=$id;
                        $ids->g1=$g1;
                        $ids->g2=$g2;
                        $ids->g3=$g3;
                        $ids->save();
                    }
        }
        else {

            foreach($cod_mascota as $id){

                        $ids=new ExamenFisicoController();
                        $ids->cod_mascota=$id;
                        $ids->g1=$g4;
                        $ids->g2=$g5;
                        $ids->g3=$g6;
                        $ids->save();
                    }
        }*/

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\examen_fisico  $examen_fisico
     * @return \Illuminate\Http\Response
     */
    public function show(examen_fisico $examen_fisico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\examen_fisico  $examen_fisico
     * @return \Illuminate\Http\Response
     */
    public function edit(examen_fisico $examen_fisico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\examen_fisico  $examen_fisico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, examen_fisico $examen_fisico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\examen_fisico  $examen_fisico
     * @return \Illuminate\Http\Response
     */
    public function destroy(examen_fisico $examen_fisico)
    {
        //
    }
}
