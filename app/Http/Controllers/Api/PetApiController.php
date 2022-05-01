<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Canton;
use App\Models\Image;
use App\Models\Pet;
use App\Models\Province;
use App\Models\User;
use Exception;
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

                    if ($input['lost']) {
                        $input['n_lost'] = 1;
                    } else {
                        $input['n_lost'] = 0;
                    }
                    $input['user_id'] = $user->user_id;

                    DB::beginTransaction();

                    $input['pet_id'] = genaretePetId($input);
                    if (isset($input['name'])) $input['name'] = ucwords(strtolower($input['name']));
                    Pet::create($input);

                    DB::commit();
                    return response()->json(['message' => 'Pet created!', 'data' => []], 200);
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

            $user = $pet->user;
            $canton = $user ? $user->canton : null;
            $province = $user ? $user->province : null;
            $parish = $user ? $user->parish : null;
            $specie = $pet->specie;
            $race = $pet->race;

            $user['canton'] = $canton ? $canton->name : null;
            $user['province'] = $province ? $province->name : null;
            $user['parish'] = $parish ? $parish->name : null;

            $pet['specie'] = $specie ? $specie->name : null;
            if ($specie)
                $pet['image_specie'] = $specie->image ? $specie->image->url : null;
            $pet['race'] = $race ? $race->name : null;
            $pet['user'] = $user;
            $data['pet'] = $pet;
            $data['images'] = $pet->images;
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

            for ($i = 0; $i < count($pets); $i++) {
                $pets[$i]['image_specie'] = $pets[$i]->specie ? $pets[$i]->specie->image : null;
            }

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

        $arrName = explode("-", $input['images'][0]['name']); // ['.....' - '.....' - '......']
        $idWithJpg = $arrName[count($arrName) - 1]; // Last position jalksdjasd.jpg
        $arridWithJpg = explode(".", $idWithJpg); // without .jpg
        $pet['pet_id'] = genaretePetId($input); //Last ID 
        $pet['name'] = 'Desconocido';
        $pet['birth'] = date('Y-m-d');
        $pet['sex'] = null;
        $pet['lost'] = true;
        $pet['published'] = true;
        $pet['specie'] = 'Desconocido';
        $pet['race'] = 'Desconocido';
        $pet['n_lost'] = 1;

        DB::beginTransaction();


        try {
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
                $image['external_id'] = $pet['pet_id'];

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

                    $input['updated_at'] = now();


                    if (!$pet->lost && isset($input['lost'])) {
                        if ($input['lost']) $input['n_lost'] = $pet->n_lost + 1;
                    }

                    DB::beginTransaction();
                    $imagesCurrent = $pet->images;
                    if (isset($input['name'])) $input['name'] = ucwords(strtolower($input['name']));
                    if (isset($input['images']))
                        foreach ($imagesCurrent as $imgC) {
                            $exist = array_search($imgC->url, array_column($input['images'], 'url'));
                            if (is_numeric($exist)) {
                                continue;
                            } else {
                                Storage::disk("google")->delete($imgC->id_image);
                                $imgC->delete();
                            }
                        }

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
                                $image['external_id'] = $pet['pet_id'];

                                Image::create($image);
                            }
                        }
                    }

                    $pet->update($input);

                    DB::commit();
                    return response()->json(['message' => 'Pet updated!', 'data' => []], 200);
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
                $input['user']['password'] = Hash::make($newUser['user_id']);
                $input['user']['api_token'] = Str::random(25);
                $pet['user_id'] = $newUser['user_id'];
                try {
                    validateUserID($pet['user_id']);
                } catch (Exception $e) {
                    return redirect()->back()->with('error', $e->getMessage());
                }
                User::create($input['user']);
                DB::commit();
            }
            $pet['name'] = $input['namepet'];
            unset($input['namepet']);
            if (isset($input['name'])) $input['name'] = ucwords(strtolower($input['name']));
            $pet['birth'] = $input['birth'];
            unset($input['birth']);
            $pet['sex'] = $input['sex'];
            unset($input['sex']);
            $pet['castrated'] = $input['castrated'];
            unset($input['castrated']);
            $pet['id_specie'] = $input['specie'];
            unset($input['id_specie']);
            $pet['id_race'] = $input['race'];
            unset($input['id_race']);
            $pet['characteristic'] = $input['characteristic'];
            unset($input['characteristic']);

            $pet['pet_id'] = genaretePetId($newUser); //Last ID
            $pet['lost'] = true;
            $pet['published'] = true;
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
                $image['external_id'] = $pet['pet_id'];

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
