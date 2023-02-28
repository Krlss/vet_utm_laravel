<?php

namespace App\Http\Controllers;

use App\deshidratacion;
use App\especie;
use Illuminate\Http\Request;

class DeshidratacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['deshidratacion']=deshidratacion::paginate(10000);
       return view('deshidratacion.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $especie=especie::all('especie');
        return view('deshidratacion.create', compact('especie'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $deshidratacion= request()->validate([
        'especie'=>'required:deshidratacions|max:255|nullable', 
        'porcentaje'=>'required:deshidratacions|max:255|numeric'
        ],[
            'porcentaje.required' => 'El porcentaje de deshidratacion es obligatorio',
            'especie.required' => 'La especie animal es obligatoria',
            'porcentaje.numeric' => 'El porcentaje debe ser numerico'
            ]);
        deshidratacion::insert($deshidratacion);
        return redirect('deshidratacion')->with('Mensaje','Datos ingresados con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\deshidratacion  $deshidratacion
     * @return \Illuminate\Http\Response
     */
    public function show(deshidratacion $deshidratacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\deshidratacion  $deshidratacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\deshidratacion  $deshidratacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, deshidratacion $deshidratacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\deshidratacion  $deshidratacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eliminar= deshidratacion::findOrFail($id);
        deshidratacion::destroy($id);
        return redirect('deshidratacion')->with('Mensaje','Datos Eliminados con exito.');
    }
}
