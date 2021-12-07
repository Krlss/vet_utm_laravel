<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Storage;

class PetApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getPetByID($id)
    {
        try {
            $pet = Pet::where('pet_id', $id)->first(); 
            if($pet) return response()->json(['message'=>'Profile of pet lost', 'data' => $pet], 200);
            return response()->json(['message'=>'pet not found', 'data' => []], 404);
        } catch (\Throwable $th) {
            return response()->json(['message'=>'Something went error', 'data' => []], 500);
        }
    }

    public function getAllPetsLost() 
    {
        try {
            $pets = Pet::where('lost', true)->get();
            if($pets) return response()->json(['message'=>'All pets lost', 'data' => $pets], 200);
            return response()->json(['message'=>'no lost pets', 'data' => []], 404);
        } catch (\Throwable $th) {
            return response()->json(['message'=>'Something went error', 'data' => []], 500);
        }
    }

    public function uploadPetUnknow(Request $request) 
    {        
        $input = $request->all(); 
        $path = public_path() . '/img/';
         
        for ($i=0; $i < count($input); $i++) { 
            $decode_file = base64_decode($input[$i]['base64']);
            /* file_put_contents($path . $input[$i]['name'], $decode_file);
            
            $img_saved = asset('/img/'. $input[$i]['name']); */
            Storage::disk("google")->put($input[$i]['name'], $decode_file);            
            $url = Storage::disk("google")->url($input[$i]['name']);
            $kjlasd = $url;
        }


        return response()->json(['message'=>'no lost pets', 'data' => []], 200);
    }
}
