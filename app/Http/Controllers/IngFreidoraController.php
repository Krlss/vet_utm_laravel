<?php

namespace App\Http\Controllers;

use App\Ing_freidora;
use App\deshidratacion;
use App\mucosas;
use App\registro_mascota;
use App\sistemas;
use App\lista_problema;
use Illuminate\Http\Request;

class IngFreidoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$datos['ing_freidora']=Ing_freidora::paginate(1000);
        $deshidratacion =deshidratacion::all();
         $mucosas =mucosas::all();
         $lista_maestra=sistemas::all();
        return view('ingreso_freidora.index',compact('deshidratacion','mucosas','lista_maestra'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ingreso_freidora.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $numero_freidora=request()->except('_token');
        Ing_freidora::insert($numero_freidora);
        return redirect('ingreso_freidora')->with('Mensaje','Datos ingresados con exito.');    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ing_freidora  $ing_freidora
     * @return \Illuminate\Http\Response
     */
    public function show(Ing_freidora $ing_freidora)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ing_freidora  $ing_freidora
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $numero_freidora= Ing_freidora::findOrFail($id);
        return view('ingreso_freidora.edit',compact('numero_freidora'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ing_freidora  $ing_freidora
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $numero_freidora=request()->except(['_token','_method']);
         
         //dd($id);
         Ing_freidora::where('id','=',$id)->update($numero_freidora);
         //$carrousell= Carrousell::findOrFail($id);

        //return view('carrousell.edit',compact('carrousell'));
        return redirect('ingreso_freidora')->with('Mensaje','Modificacion realizada con exito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ing_freidora  $ing_freidora
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eliminar= Ing_freidora::findOrFail($id);
         Ing_freidora::destroy($id);
        return redirect('ingreso_freidora')->with('Mensaje','Datos Eliminados con exito.');
    }
}
