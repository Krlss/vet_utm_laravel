<?php

namespace App\Http\Controllers;

use App\desparasitante;
use App\especie;
use Illuminate\Http\Request;

class DesparasitanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['desparasitante']=desparasitante::paginate(1000);
        
        return view('desparasitante.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $especie=especie::all('especie');
         return view('desparasitante.create',compact('especie'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lista_problemas=request()->except('_token');
        desparasitante::insert($lista_problemas);
        return redirect('desparasitante')->with('Mensaje','Datos ingresados con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\desparasitante  $desparasitante
     * @return \Illuminate\Http\Response
     */
    public function show(desparasitante $desparasitante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\desparasitante  $desparasitante
     * @return \Illuminate\Http\Response
     */
    public function edit(desparasitante $desparasitante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\desparasitante  $desparasitante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, desparasitante $desparasitante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\desparasitante  $desparasitante
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eliminar= desparasitante::findOrFail($id);
         desparasitante::destroy($id);
        return redirect('desparasitante')->with('Mensaje','Datos Eliminados con exito.');
    }
}
