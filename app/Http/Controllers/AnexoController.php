<?php

namespace App\Http\Controllers;

use App\anexo;
use App\hoja_clinica;
use App\registro_mascota;
use Illuminate\Http\Request;

class AnexoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $datos['hoja_clinica']=registro_mascota::all();
       return view('anexos.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function listado($pet_id)
    {
       $datos['anexo']=anexo::all();
       return view('anexos.listado',$datos);
    }


    public function create($pet_id)
    {   $mascota=registro_mascota::all()->where('cod_mascota',$pet_id);
        $anexo=anexo::all()->where('cod_mascota',$pet_id);
        return view('anexos.create', compact('anexo','mascota'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $anexo=request()->except('_token');
        anexo::insert($anexo);
        return redirect('anexos/listado/'.$request->cod_mascota)->with('Mensaje','Anexo ingresado con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Anexos  $anexo
     * @return \Illuminate\Http\Response
     */
    public function show(anexo $anexo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Anexos  $clientes
     * @return \Illuminate\Http\Response
     */
    public function edit(anexo $anexo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Anexos  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, anexo $anexo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Anexos  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eliminar= anexo::findOrFail($id);
        anexo::destroy($id);
        return redirect('anexos/')->with('Mensaje','Datos Eliminados con exito.');
    }
}
