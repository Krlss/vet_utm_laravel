<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Canton;
use App\Models\Image;
use App\Models\Pet;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        $input = $request->all();
        $header = $request->header('Authorization');

        if ($header) {
            $user = User::where('api_token', $header)->first();
            if ($user) {
                try {
                    $canton = Canton::where('id', $user->id_canton)->first();
                    $province = $canton ? Province::where('id', $canton->id_province)->first() : null;

                    if ($input['lost']) {
                        $input['n_lost'] = 1;
                    } else {
                        $input['n_lost'] = 0;
                    }
                    $input['user_id'] = $user->user_id;

                    DB::beginTransaction();

                    $input['pet_id'] = $this->genaretePetId($input);

                    Pet::create($input);

                    $pet = Pet::where('user_id', $user->user_id)->get();

                    $user['pet'] = $pet;
                    $user['canton'] = $canton;
                    $user['province'] = $province;

                    DB::commit();
                    return response()->json(['message' => 'Pet created!', 'data' => $user], 200);
                } catch (\Throwable $th) {
                    return response()->json(['message' => 'Something went error', 'data' => $th], 500);
                }
            } else {
                return response()->json(['message' => 'User not found', 'data' => []], 404);
            }
        } else {
            return response()->json(['message' => 'you do not have permission to create a new pet in that profile', 'data' => []], 401);
        }
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

            $user = User::where('user_id', $pet->user_id)->first();
            $canton = $user ? Canton::where('id', $user->id_canton)->first() : null;
            $user['canton'] = $canton;
            $pet['user'] = $user;
            $images = Image::where('pet_id', $pet->pet_id)->get();
            $data['pet'] = $pet;
            $data['images'] = $images;
            if ($pet) return response()->json(['message' => 'Profile of pet lost', 'data' => $data], 200);
            return response()->json(['message' => 'pet not found', 'data' => []], 404);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Something went error', 'data' => []], 500);
        }
    }

    public function getAllPetsLost()
    {
        try {
            $pets = Pet::where('lost', true)->where('published', true)->get();
            if ($pets) {
                return response()->json(['message' => 'All pets lost', 'data' => $pets], 200);
            }
            return response()->json(['message' => 'no lost pets', 'data' => []], 404);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Something went error', 'data' => []], 500);
        }
    }

    public function uploadPetUnknow(Request $request)
    {
        $input = $request->all();

        $arrName = explode("-", $input[0]['name']); // ['.....' - '.....' - '......']
        $idWithJpg = $arrName[count($arrName) - 1]; // Last position jalksdjasd.jpg
        $arridWithJpg = explode(".", $idWithJpg); // without .jpg
        $pet['pet_id'] = strtoupper($arridWithJpg[0] . rand(100, 999)); //Last ID
        $pet['name'] = 'Desconocido';
        $pet['birth'] = date('Y-m-d');
        $pet['sex'] = null;
        $pet['lost'] = true;
        $pet['published'] = false;
        $pet['specie'] = 'Desconocido';
        $pet['race'] = 'Desconocido';
        $pet['n_lost'] = 1;

        DB::beginTransaction();


        try {
            Pet::create($pet);

            for ($i = 0; $i < count($input); $i++) {

                $decode_file = base64_decode($input[$i]['base64']);

                Storage::disk("google")->put($input[$i]['name'], $decode_file);

                $urlGoogleImage = Storage::disk("google")->url($input[$i]['name']);
                $urlG = explode('=', $urlGoogleImage);
                $id_img = explode('&', $urlG[1]);

                $image['id_image'] = $id_img[0];
                $image['url'] = $urlGoogleImage;
                $image['name'] = $input[$i]['name'];
                $image['pet_id'] = $pet['pet_id'];

                Image::create($image);
            }

            DB::commit();
            return response()->json(['message' => 'Report is ok...', 'data' => []], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => 'Something went error...', 'data' => []], 500);
        }
    }

    public function updateDataPet(Request $request)
    {
        $input = $request->all();
        $header = $request->header('Authorization');

        if ($header) {
            $pet = Pet::where('pet_id', $input['pet_id'])->first();
            if ($pet) {
                try {

                    if (isset($input['user_id'])) {
                        $user = User::where('user_id', $input['user_id'])->first();
                        if (!$user) return response()->json(['message' => 'User not found', 'data' => []], 404);
                    }

                    $user = User::where('user_id', $pet->user_id)->first();
                    $canton = Canton::where('id', $user->id_canton)->first();
                    $province = $canton ? Province::where('id', $canton->id_province)->first() : null;
                    $input['updated_at'] = now();


                    if (!$pet->lost && isset($input['lost'])) {
                        if ($input['lost']) $input['n_lost'] = $pet->n_lost + 1;
                    }

                    DB::beginTransaction();
                    /*                    $imagesCurrent = Image::where('pet_id',$input['pet_id'])->get();


                     foreach($imagesCurrent as $imgC){
                        if(isset($input['images']))
                            $exist = array_search($imgC->url, array_column($input['images'], 'url'));
                        else $exist = null;
                        
                        if(is_numeric($exist)){
                            continue;
                        }else{            
                            Storage::disk("google")->delete($imgC->id_image);
                            $imgC->delete();
                        }
                    } */

                    if (isset($input['images'])) {
                        for ($i = 0; $i < count($input['images']); $i++) {
                            if (isset($input['images'][$i]['base64'])) {
                                $decode_file = base64_decode($input['images'][$i]['base64']);

                                Storage::disk("google")->put($input['images'][$i]['name'], $decode_file);

                                $urlGoogleImage = Storage::disk("google")->url($input['images'][$i]['name']);
                                $urlG = explode('=', $urlGoogleImage);
                                $id_img = explode('&', $urlG[1]);

                                $image['id_image'] = $id_img[0];
                                $image['url'] = $urlGoogleImage;
                                $image['name'] = $input['images'][$i]['name'];
                                $image['pet_id'] = $pet['pet_id'];

                                Image::create($image);
                            }
                        }
                    }

                    $pet->update($input);

                    $user['pet'] = $pet;
                    $user['canton'] = $canton;
                    $user['province'] = $province;

                    DB::commit();
                    return response()->json(['message' => 'Pet updated!', 'data' => $user], 200);
                } catch (\Throwable $th) {
                    return response()->json(['message' => 'Something went error', 'data' => $th], 500);
                }
            } else {
                return response()->json(['message' => 'Pet not found', 'data' => []], 404);
            }
        } else {
            return response()->json(['message' => 'you are not authorized to update that profile', 'data' => []], 401);
        }
    }

    public function genaretePetId($input)
    {
        /* name, sex, birth, castrated, race, specie */
        /* PRIMERA LETRA NOMBRE + 
        SEXO + 
        AÑO NACIMIENTO + 
        Día en que se registró +
        CASTRADO + 
        PRIMERA LETRA RAZA + 
        PRIMERA LETRA ESPECIE + 
        numbero random 1000 to 9999  */

        /* PM202007YBP9999  */

        $name = $input['name'];
        $birth = $input['birth'];
        $arrBirth = explode("-", $birth);
        $day = date("d");
        $castrated = $input['castrated'] === 0 ? 'F' : 'M';
        $race = $input['race'];
        $specie = $input['specie'];
        $input['sex'] = $input['sex'] ? $input['sex'] : 'D';

        return strtoupper($name[0] . $input['sex'] . $arrBirth[0] . $day . $castrated . $race[0] . $specie[0] . rand(1000, 9999));
    }

    public function reportPet(Request $request)
    {
        $input = $request->all();



        DB::beginTransaction();


        try {
            $newUser['user_id'] = $input['user']['user_id'];
            $newUser['phone'] = $input['user']['phone'];
            $newUser['email'] = $input['user']['email'];


            $user = User::where('user_id', $newUser['user_id'])
                ->orWhere('phone', $newUser['phone'])
                ->orWhere('email', $newUser['email'])
                ->first();


            if ($user) {
                $pet['user_id'] = $user->user_id;
            } else {
                unset($input['user']['id_province']); //delete
                $input['user']['password'] = Hash::make($newUser['user_id']);
                $input['user']['api_token'] = Str::random(25);
                $pet['user_id'] = $newUser['user_id'];
                User::create($input['user']);
            }
            unset($input['user']);
            $pet['name'] = $input['namepet'];
            unset($input['namepet']);
            $pet['birth'] = $input['birth'];
            unset($input['birth']);
            $pet['sex'] = $input['sex'];
            unset($input['sex']);
            $pet['castrated'] = $input['castrated'];
            unset($input['castrated']);
            $pet['specie'] = $input['specie'];
            unset($input['specie']);
            $pet['race'] = $input['race'];
            unset($input['race']);
            $pet['pet_id'] = $this->genaretePetId($pet); //Last ID
            $pet['lost'] = true;
            $pet['published'] = false;
            $pet['n_lost'] = 1;


            Pet::create($pet);

            for ($i = 0; $i < count($input['images']); $i++) {

                $decode_file = base64_decode($input['images'][$i]['base64']);

                Storage::disk("google")->put($input['images'][$i]['name'], $decode_file);

                $urlGoogleImage = Storage::disk("google")->url($input['images'][$i]['name']);
                $urlG = explode('=', $urlGoogleImage);
                $id_img = explode('&', $urlG[1]);

                $image['id_image'] = $id_img[0];
                $image['url'] = $urlGoogleImage;
                $image['name'] = $input['images'][$i]['name'];
                $image['pet_id'] = $pet['pet_id'];

                Image::create($image);
            }

            DB::commit();
            return response()->json(['message' => 'Report is ok...', 'data' => []], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => 'Something went error...', 'data' => []], 500);
        }
    }
}
