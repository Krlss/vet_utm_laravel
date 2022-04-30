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
                    $canton = Canton::where('id', $user->id_canton)->first();
                    $province = $canton ? Province::where('id', $canton->id_province)->first() : null;

                    if ($input['lost']) {
                        $input['n_lost'] = 1;
                    } else {
                        $input['n_lost'] = 0;
                    }
                    $input['user_id'] = $user->user_id;

                    DB::beginTransaction();

                    $input['pet_id'] = $this->genaretePetId($input['public_ip']);
                    if (isset($input['name'])) $input['name'] = ucwords(strtolower($input['name']));
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

        $arrName = explode("-", $input['images'][0]['name']); // ['.....' - '.....' - '......']
        $idWithJpg = $arrName[count($arrName) - 1]; // Last position jalksdjasd.jpg
        $arridWithJpg = explode(".", $idWithJpg); // without .jpg
        $pet['pet_id'] = $this->genaretePetId($input['public_ip']); //Last ID
        unset($input['public_ip']);
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
                    $imagesCurrent = Image::where('pet_id', $input['pet_id'])->get();
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
        /* FIRST letter of province + secuencial two letter a-z more secuencial number 001-999*/
        /* MAA-001 */
        /* MZZ-999 */

        $url = "http://ip-api.com/json/" . $input;
        $region = json_decode(file_get_contents($url));
        $letter_user = null;

        if ($region->status == "success") {
            $region = $region->region ? $region->region : 'D';
        } else {
            $region = 'D';
        }

        if (isset($input['user_id'])) {
            $user = User::where('user_id', $input['user_id'])->pluck('id_province');
            $letter_user = Province::where('id', $user)->pluck('letter');
            if (count($letter_user)) $region = $letter_user[0];
        }

        $provinces_letter = Province::pluck('letter');

        $letters = [];

        foreach ($provinces_letter as $i) {
            foreach ($provinces_letter as $j) {
                array_push($letters, $i . $j);
            }
        }

        $last_pet = Pet::where('pet_id', 'like', strtoupper($region) . '%')->orderBy('pet_id', 'DESC')->pluck('pet_id')->first();

        if (!$last_pet) {
            //Letter[0] is AA (?). First pet register.
            $last_pet = strtoupper($region . $letters[0] . '-' . '0001');
        } else {
            //pet_id convert to array ['MGF', '065];
            $array_petID = explode("-", $last_pet);

            //get number
            $num_int = intval($array_petID[1]);
            $new_num = '';

            $newCombination = '';
            $array_letter = [];

            if ($num_int == 9999) {
                //get last combination for generate new
                $array_letter = explode($region, $array_petID[0]);

                for ($i = 0; $i < count($letters); $i++) {
                    //get next combination
                    if ($letters[$i] == $array_letter[1]) {
                        $newCombination = $letters[$i + 1];
                    }
                }
                $last_pet = strtoupper($region . $newCombination . "-" . '0001');
            } else {
                $num_int = $num_int + 1;

                //get last combination
                $array_letter = explode($region, $array_petID[0]);

                if ($num_int < 10) $new_num = '000' . $num_int;
                elseif ($num_int < 100) $new_num = '00' . $num_int;
                elseif ($num_int < 1000) $new_num = '0' . $num_int;
                else $new_num = '' . $new_num;

                $last_pet = strtoupper($region . $array_letter[1] . "-" . $new_num);
            }
        }

        return $last_pet;
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
            $pet['specie'] = $input['specie'];
            unset($input['specie']);
            $pet['race'] = $input['race'];
            unset($input['race']);

            $pet['pet_id'] = $this->genaretePetId($input['user']['public_ip']); //Last ID
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
