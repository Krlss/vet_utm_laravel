<?php

namespace App\Http\Controllers;

use App\raza;
use App\especie;
use Illuminate\Http\Request;

class RazaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $datos['raza']=raza::all();
        return view('ingreso_raza.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $especie=especie::all('especie');
        return view('ingreso_raza.create', compact('especie'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $raza= request()->except('_token');
        raza::insert($raza);
        return redirect('ingreso_raza')->with('Mensaje','Datos ingresados con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\raza  $raza
     * @return \Illuminate\Http\Response
     */
    public function show(raza $raza)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\raza  $raza
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $raza=raza::findOrFail($id);
        return view('ingreso_raza.edit', compact('raza'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\raza  $raza
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $raza=request()->except(['_token','_method']);
         
         raza::where('id','=',$id)->update($raza);

        return redirect('ingreso_raza')->with('Mensaje','Modificacion realizada con exito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\raza  $raza
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eliminar= raza::findOrFail($id);
        raza::destroy($id);
        return redirect('ingreso_raza')->with('Mensaje','Datos Eliminados con exito.');
    }
}
