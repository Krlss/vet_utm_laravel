<?php

namespace App\Http\Controllers;

use App\test_patron;
use Illuminate\Http\Request;

class TestPatronController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('test_patron.index');
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
     * @param  \App\test_patron  $test_patron
     * @return \Illuminate\Http\Response
     */
    public function show(test_patron $test_patron)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\test_patron  $test_patron
     * @return \Illuminate\Http\Response
     */
    public function edit(test_patron $test_patron)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\test_patron  $test_patron
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, test_patron $test_patron)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\test_patron  $test_patron
     * @return \Illuminate\Http\Response
     */
    public function destroy(test_patron $test_patron)
    {
        //
    }
}
