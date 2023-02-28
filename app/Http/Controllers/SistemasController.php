<?php

namespace App\Http\Controllers;

use App\sistemas;
use App\examen_fisico;
use Illuminate\Http\Request;

class SistemasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['sistemas']=sistemas::paginate(1000);
        return view('ing_lista_maestra.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('ing_lista_maestra.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sistemas= $request->validate([
        'nom_sistema'=>'required|unique:sistemas|max:255|nullable',      
        ], [
            'nom_sistema.required' => 'El campo sistema es obligatorio',
            'nom_sistema.unique' => 'Ya existe un sistema con ese nombre'
            ]);
        sistemas::insert($sistemas);
        return redirect('ing_lista_maestra')->with('Mensaje','Datos ingresados con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\sistemas  $sistemas
     * @return \Illuminate\Http\Response
     */
    public function show(sistemas $sistemas)
    {
        $examen= examen_fisico::all()->where('cod_mascota','MBA-8998');
        return view('ing_lista_maestra.show',compact('examen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\sistemas  $sistemas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sistemas=sistemas::findOrFail($id);
        return view('ing_lista_maestra.edit',compact('sistemas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sistemas  $sistemas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sistemas=request()->except(['_token','_method']);
         
        sistemas::where('id','=',$id)->update($sistemas);
        return redirect('ing_lista_maestra')->with('Mensaje','Modificacion realizada con exito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\sistemas  $sistemas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eliminar= sistemas::findOrFail($id);
        sistemas::destroy($id);
        return redirect('ing_lista_maestra')->with('Mensaje','Datos Eliminados con exito.');
    }
}
