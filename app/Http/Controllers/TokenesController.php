<?php

namespace App\Http\Controllers;

use App\Tokenes;
use Illuminate\Http\Request;
use App\Urbanizaciones;

class TokenesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $urbanizaciones=Urbanizaciones::all('nombre_urbanizacion');
        $datos['tokenes']=Tokenes::paginate(10);
        return view('tokenes.index',compact('datos','urbanizaciones'));
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
     * @param  \App\Tokenes  $tokenes
     * @return \Illuminate\Http\Response
     */
    public function show(Tokenes $tokenes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tokenes  $tokenes
     * @return \Illuminate\Http\Response
     */
    public function edit(Tokenes $tokenes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tokenes  $tokenes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tokenes $tokenes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tokenes  $tokenes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tokenes $tokenes)
    {
        //
    }
}
