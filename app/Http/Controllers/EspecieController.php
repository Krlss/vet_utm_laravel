<?php

namespace App\Http\Controllers;

use App\especie;
use Illuminate\Http\Request;

class EspecieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['especie']=especie::paginate(1000);
        return view('ingreso_especie.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ingreso_especie.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $especie=request()->except('_token');
        especie::insert($especie);
        return redirect('ingreso_especie')->with('Mensaje','Datos ingresados con exito.'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\especie  $especie
     * @return \Illuminate\Http\Response
     */
    public function show(especie $especie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\especie  $especie
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $especie= especie::findOrFail($id);
        return view('ingreso_especie.edit',compact('especie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\especie  $especie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $especie=request()->except(['_token','_method']);

         especie::where('id','=',$id)->update($especie);

        return redirect('ingreso_especie')->with('Mensaje','Modificacion realizada con exito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\especie  $especie
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eliminar= especie::findOrFail($id);
        especie::destroy($id);
        return redirect('ingreso_especie')->with('Mensaje','Datos Eliminados con exito.');
    }
}
