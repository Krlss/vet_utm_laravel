<?php

namespace App\Http\Controllers;

use App\vacunacion;
use App\vacuna;
use App\hoja_clinica;
use App\registro_mascota;

use Illuminate\Http\Request;

class VacunacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['hoja_clinica']=registro_mascota::paginate(1000);
        return view('ingreso_vacunacion.index',$datos);
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
     * @param  \App\vacunacion  $vacunacion
     * @return \Illuminate\Http\Response
     */
    public function show(vacunacion $vacunacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\vacunacion  $vacunacion
     * @return \Illuminate\Http\Response
     */
    public function edit(vacunacion $vacunacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\vacunacion  $vacunacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, vacunacion $vacunacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\vacunacion  $vacunacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(vacunacion $vacunacion)
    {
        //
    }
}
