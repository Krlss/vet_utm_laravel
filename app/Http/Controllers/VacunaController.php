<?php

namespace App\Http\Controllers;

use App\vacuna;
use App\especie;
use Illuminate\Http\Request;

class VacunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['vacuna']=vacuna::paginate(1000);
        return view('ingreso_vacuna.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $especie=especie::all();
        return view('ingreso_vacuna.create',compact('especie'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vacuna = $request->validate([
        'especie'=>'required:vacunas|max:255|nullable', 
        'nom_vacuna'=>'required|unique:vacunas|max:255|nullable'
        ],[
            'nom_vacuna.required' => 'El nombre de vacuna es obligatorio',
            'especie.required' => 'La especie animal es obligatoria',
            'nom_vacuna.unique' => 'Ya existe una vacuna con ese nombre'
            ]);

        vacuna::insert($vacuna);
        return redirect('ingreso_vacuna')->with('Mensaje','Datos ingresados con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\vacuna  $vacuna
     * @return \Illuminate\Http\Response
     */
    public function show(vacuna $vacuna)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\vacuna  $vacuna
     * @return \Illuminate\Http\Response
     */
    public function edit(vacuna $vacuna)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\vacuna  $vacuna
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, vacuna $vacuna)
    {
        $nombre_grupo_trabajo=request()->except(['_token','_method']);
         
         //dd($id);
         vacuna::where('id','=',$id)->update($nombre_grupo_trabajo);
         //$carrousell= Carrousell::findOrFail($id);

        //return view('carrousell.edit',compact('carrousell'));
        return redirect('ingreso_vacuna')->with('Mensaje','Modificacion realizada con exito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\vacuna  $vacuna
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eliminar= vacuna::findOrFail($id);
         vacuna::destroy($id);
        return redirect('ingreso_vacuna')->with('Mensaje','Datos Eliminados con exito.');
    }
}
