<?php

namespace App\Http\Controllers;

use App\registro_mascota;
use Illuminate\Http\Request;

class RegistroMascotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $datos['mascota']=registro_mascota::paginate(1000);
        return view('ingreso_mascota.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mascota=registro_mascota::all('mascota');
        return view('ingreso_mascota.create', compact('mascota'));
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
     * @param  \App\registro_mascota  $registro_mascota
     * @return \Illuminate\Http\Response
     */
    public function show(registro_mascota $registro_mascota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\registro_mascota  $registro_mascota
     * @return \Illuminate\Http\Response
     */
    public function edit(registro_mascota $registro_mascota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\registro_mascota  $registro_mascota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, registro_mascota $registro_mascota)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\registro_mascota  $registro_mascota
     * @return \Illuminate\Http\Response
     */
    public function destroy(registro_mascota $registro_mascota)
    {
        //
    }
}
