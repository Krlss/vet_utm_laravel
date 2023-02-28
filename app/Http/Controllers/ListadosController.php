<?php

namespace App\Http\Controllers;

use App\Listados;
use Illuminate\Http\Request;
use App\User;

class ListadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $usuarios=User::all('name','cedula','urbanizacion','Foto');
        $datos['listados']=Listados::paginate(10);
    return view('listados.index',compact('datos','usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Listados  $listados
     * @return \Illuminate\Http\Response
     */
    public function show(Listados $listados)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Listados  $listados
     * @return \Illuminate\Http\Response
     */
    public function edit(Listados $listados)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Listados  $listados
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Listados $listados)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Listados  $listados
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listados $listados)
    {
        //
    }
}
