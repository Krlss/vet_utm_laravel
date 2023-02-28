<?php

namespace App\Http\Controllers;

use App\mucosas;
use App\sistemas;
use App\lista_problema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MucosasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $sistemas =sistemas::all('nom_sistema');
        return view('mucosas.index', compact('sistemas'));
    }

    public function get_problema(Request $request, $id)
    {   
        if($request->ajax()){
            $problema=lista_problema::problemas($id);
            return response()->json($problema);
        }
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
     * @param  \App\mucosas  $mucosas
     * @return \Illuminate\Http\Response
     */
    public function show(mucosas $mucosas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\mucosas  $mucosas
     * @return \Illuminate\Http\Response
     */
    public function edit(mucosas $mucosas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\mucosas  $mucosas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, mucosas $mucosas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\mucosas  $mucosas
     * @return \Illuminate\Http\Response
     */
    public function destroy(mucosas $mucosas)
    {
        //
    }
}
