<?php

namespace App\Http\Controllers;

use App\ingresos;
use App\User;
use Auth;
use Illuminate\Http\Request;

class IngresosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ingresos.index');
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
     * @param  \App\ingresos  $ingresos
     * @return \Illuminate\Http\Response
     */
    public function show(ingresos $ingresos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ingresos  $ingresos
     * @return \Illuminate\Http\Response
     */
    public function edit(ingresos $ingresos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ingresos  $ingresos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ingresos $ingresos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ingresos  $ingresos
     * @return \Illuminate\Http\Response
     */
    public function destroy(ingresos $ingresos)
    {
        //
    }
}
