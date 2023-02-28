<?php

namespace App\Http\Controllers;

use App\tipo_pelaje;
use App\especie;
use Illuminate\Http\Request;

class TipoPelajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['tipo_pelaje']=tipo_pelaje::paginate(1000);
        return view('ingreso_tipo_pelaje.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $especie=especie::all('especie');
        return view('ingreso_tipo_pelaje.create', compact('especie'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipo_pelaje= request()->except('_token');
        tipo_pelaje::insert($tipo_pelaje);
        return redirect('ingreso_tipo_pelaje')->with('Mensaje','Datos ingresados con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tipo_pelaje  $tipo_pelaje
     * @return \Illuminate\Http\Response
     */
    public function show(tipo_pelaje $tipo_pelaje)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tipo_pelaje  $tipo_pelaje
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelaje=tipo_pelaje::findOrFail($id);
        return view('ingreso_tipo_pelaje.edit', compact($pelaje));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tipo_pelaje  $tipo_pelaje
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tipo_pelaje $tipo_pelaje)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tipo_pelaje  $tipo_pelaje
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eliminar= tipo_pelaje::findOrFail($id);
        tipo_pelaje::destroy($id);
        return redirect('ingreso_tipo_pelaje')->with('Mensaje','Datos Eliminados con exito.');
    }
}
