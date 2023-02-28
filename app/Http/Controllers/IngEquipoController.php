<?php

namespace App\Http\Controllers;

use App\ing_equipo;
use Illuminate\Http\Request;

class IngEquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['ing_equipo']=ing_equipo::paginate(1000);
        return view('ingreso_equipo.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ingreso_equipo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $nombre_equipo=request()->except('_token');
        ing_equipo::insert($nombre_equipo);
        return redirect('ingreso_equipo')->with('Mensaje','Datos ingresados con exito.'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ing_equipo  $ing_equipo
     * @return \Illuminate\Http\Response
     */
    public function show(ing_equipo $ing_equipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ing_equipo  $ing_equipo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nombre_equipo= ing_equipo::findOrFail($id);
        return view('ingreso_equipo.edit',compact('nombre_equipo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ing_equipo  $ing_equipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $nombre_equipo=request()->except(['_token','_method']);
         
         //dd($id);
         ing_equipo::where('id','=',$id)->update($nombre_equipo);
         //$carrousell= Carrousell::findOrFail($id);

        //return view('carrousell.edit',compact('carrousell'));
        return redirect('ingreso_equipo')->with('Mensaje','Modificacion realizada con exito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ing_equipo  $ing_equipo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eliminar= ing_equipo::findOrFail($id);
         ing_equipo::destroy($id);
        return redirect('ingreso_equipo')->with('Mensaje','Datos Eliminados con exito.');
    }
}
