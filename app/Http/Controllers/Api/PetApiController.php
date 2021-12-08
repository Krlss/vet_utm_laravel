<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            $pet = Pet::where('pet_id', $id)
            ->where('published', true)
            ->first();            
            $images = Image::where('pet_id', $pet->pet_id)->get(); 
            $data['pet'] = $pet;
            $data['images'] = $images;
            if($pet) return response()->json(['message'=>'Profile of pet lost', 'data' => $data], 200);
            return response()->json(['message'=>'pet not found', 'data' => []], 404);
        } catch (\Throwable $th) {
            return response()->json(['message'=>'Something went error', 'data' => []], 500);
        }
    }

    public function getAllPetsLost() 
    {
        try {
            $pets = Pet::where('lost', true)->where('published', true)->get();

            if($pets) {
                return response()->json(['message'=>'All pets lost', 'data' => $pets], 200);
            }
            return response()->json(['message'=>'no lost pets', 'data' => []], 404);
        } catch (\Throwable $th) {
            return response()->json(['message'=>'Something went error', 'data' => []], 500);
        }
    }

    public function uploadPetUnknow(Request $request) 
    {        
        $input = $request->all();  

        $arrName = explode("-", $input[0]['name']); // ['.....' - '.....' - '......']
        $idWithJpg = $arrName[count($arrName) - 1]; // Last position jalksdjasd.jpg
        $arridWithJpg = explode(".", $idWithJpg); // without .jpg
        $pet['pet_id'] = strtoupper($arridWithJpg[0] . rand(100, 999)); //Last ID
        $pet['name'] = '#########';
        $pet['birth'] = date('Y-m-d');
        $pet['sex'] = null;
        $pet['lost'] = true;
        $pet['published'] = false;
        $pet['specie'] = '#########';
        $pet['race'] = '#########';
        $pet['n_lost'] = 1;

        DB::beginTransaction();


        try {
            Pet::create($pet);

            for ($i=0; $i < count($input); $i++) { 

                $decode_file = base64_decode($input[$i]['base64']);     

                Storage::disk("google")->put($input[$i]['name'], $decode_file); 

                $urlGoogleImage = Storage::disk("google")->url($input[$i]['name']);                
                $urlG = explode('=',$urlGoogleImage);            
                $id_img = explode('&', $urlG[1]);

                $image['id_image'] = $id_img[0];
                $image['url'] = $urlGoogleImage;
                $image['name'] = $input[$i]['name'];
                $image['pet_id'] = $pet['pet_id'];

                Image::create($image);
            }

            DB::commit();           
            return response()->json(['message'=>'Report is ok...', 'data' => []], 200); 
        } catch (\Throwable $th) {
            DB::rollBack();     
            return response()->json(['message'=>'Something went error...', 'data' => []], 500);
        }
     
    }
}
