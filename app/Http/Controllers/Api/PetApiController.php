<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Canton;
use App\Models\Image;
use App\Models\Pet;
use App\Models\Province;
use App\Models\Parish;
use App\Models\Specie;
use App\Models\Race;
use App\Models\Fur;
use App\Models\User;
use App\Models\Report;
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
            $token = explode(' ', $header)[1];
            $user = User::where('api_token', $token)->first();
            if ($user) {
                try {

                    $input['n_lost'] = 0;
                    $input['user_id'] = $user->user_id;

                    DB::beginTransaction();

                    $input['pet_id'] = genaretePetId($input);
                    if (isset($input['name'])) $input['name'] = ucwords(strtolower($input['name']));
                    Pet::create($input);

                    DB::commit();


                    $pet = $user->pets;
                    $user->canton;
                    $user->province;
                    $user->parish;

                    for ($i = 0; $i < count($pet); $i++) {
                        if ($user->pets[$i]->specie)
                            $user->pets[$i]['image_specie'] = $pet[$i]->specie->image ? $pet[$i]->specie->image->url : null;
                        $user->pets[$i]['images'] = $pet[$i]->images;
                        $user->pets[$i]['specie'] = $pet[$i]->specie ? $pet[$i]->specie->name : null;
                        $user->pets[$i]['race'] = $pet[$i]->race ? $pet[$i]->race->name : null;
                        $user->pets[$i]['fur'] = $pet[$i]->fur ? $pet[$i]->fur->name : null;
                    }

                    return response()->json([
                        'type' => 'success',
                        'title' => __('Created data done successfully'),
                        'message' => __('Pet created successfully'),
                        'user' => $user
                    ], 200);
                } catch (\Throwable $th) {
                    return response()->json([
                        'type' => 'error',
                        'title' => __('Error'),
                        'message' => __('Something went error'),
                    ], 500);
                }
            } else {
                return response()->json([
                    'type' => 'error',
                    'title' => __('Error'),
                    'message' => __('User not found'),
                ], 404);
            }
        } else {
            return response()->json([
                'type' => 'error',
                'title' => __('Error'),
                'message' => __('You do not have permission to create a new pet in that profile')
            ], 401);
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
            $species = Specie::select('name', 'id')->orderBy('name', 'ASC')->get();

            foreach ($species as $specie) {
                $specie['uri'] = $specie->image ? $specie->image->url : null;
                $specie['active'] = false;
                unset($specie['image']);
            }

            $pets = Pet::with(['reports' => function ($query) {
                $query->where('active', true)->get();
            }])
                ->where('published', true)
                ->where('lost', true)
                ->orderBy('created_at', 'asc')
                ->paginate(50);

            foreach ($pets as $pet) {
                $pet['specie_name'] = $pet->specie ? $pet->specie->name : null;
                $pet['specie_image'] =  $pet->specie->image->url ?? null;
                $pet['race_name'] = $pet->race ? $pet->race->name : null;
                $pet['fur_name'] = $pet->fur ? $pet->fur->name : null;
                $pet['images'] = $pet->images;
                $pet['user'] = $pet->user;
                $pet['report'] = count($pet['reports']) ? $pet['reports'][count($pet['reports']) - 1] : null;
                $pet['report_date'] = $pet['report'] ? $pet['report']->created_at : null;
                unset($pet['reports']);
                unset($pet['specie']);
                unset($pet['race']);
                unset($pet['fur']);
            }

            return response()->json(['message' => 'All pets lost', 'species' => $species, 'pets' => $pets], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Something went error', 'data' => []], 500);
        }
    }

    public function uploadPetUnknow(Request $request)
    {
        $input = $request->all();

        $pet['pet_id'] = genaretePetId($input); //Last ID 
        $pet['name'] = 'Desconocido';
        $pet['sex'] = null;
        $pet['lost'] = true;
        $pet['published'] = true;
        $pet['n_lost'] = 1;


        $location = isset($input['location']) ? json_decode($input['location']) : null;

        $report['latitude'] = $location->latitude ?? null;
        $report['longitude'] = $location->longitude ?? null;
        $report['active'] = true;
        $report['pet_id'] = $pet['pet_id'];
        $report['user_id'] = isset($input['user_id']) ? $input['user_id'] : null;
        $report['created_at'] = date('Y-m-d H:i:s');
        $report['updated_at'] = date('Y-m-d H:i:s');

        DB::beginTransaction();

        try {
            Pet::create($pet);
            Report::create($report);

            if ($request->hasFile('images'))
                uploadImage($request->file('images'), $pet['pet_id']);

            DB::commit();

            return response()->json([
                'type' => 'success',
                'title' => __('Report done successfully'),
                'message' => __('At home slide to refresh the reports')
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'type' => 'error',
                'title' => __('Error in create report'),
                'message' => __('Try again'),
                'errors' => $th->getMessage()
            ], 500);
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
                    $user = null;

                    if (isset($input['user_id'])) {
                        $user = User::where('user_id', $input['user_id'])->first();
                        if (!$user) return response()->json([
                            'type' => 'error',
                            'title' => __('Error in update data'),
                            'message' => __('User not found')
                        ], 404);
                    }

                    $input['updated_at'] = now();


                    if (!$pet->lost && isset($input['lost'])) {
                        if ($input['lost']) $input['n_lost'] = $pet->n_lost + 1;
                    }

                    if (isset($input['new_user_id'])) {
                        if ($input['new_user_id'] != $pet->user_id) {
                            $input['user_id'] = null;
                        } else {
                            unset($input['new_user_id']);
                        }
                    }

                    if (isset($input['id_fur'])) {
                        $input['id_fur'] = $input['id_fur'] == "undefined" ? null : $input['id_fur'];
                    }

                    DB::beginTransaction();
                    if (isset($input['name'])) $input['name'] = ucwords(strtolower($input['name']));

                    if ($request->hasFile('images')) {
                        uploadImage($input['images'], $input['pet_id'], true);
                    }

                    if ($pet->lost && isset($input['lost'])) {
                        if ($input['lost']) {
                            Report::where('pet_id', $pet['pet_id'])->update(['active' => false]);
                        }
                    }

                    $location = isset($input['location']) ? json_decode($input['location']) : null;

                    if ($location) {
                        $report['latitude'] = $location->latitude ?? null;
                        $report['longitude'] = $location->longitude ?? null;
                        $report['active'] = true;
                        $report['pet_id'] = $pet['pet_id'];
                        $report['user_id'] = isset($input['user_id']) ? $input['user_id'] : null;
                        $report['created_at'] = date('Y-m-d H:i:s');
                        $report['updated_at'] = date('Y-m-d H:i:s');
                        Report::create($report);
                    }

                    $pet->update($input);

                    $pet = $user->pets;
                    $user->canton;
                    $user->province;
                    $user->parish;

                    for ($i = 0; $i < count($pet); $i++) {
                        if ($user->pets[$i]->specie)
                            $user->pets[$i]['image_specie'] = $pet[$i]->specie->image ? $pet[$i]->specie->image->url : null;
                        $user->pets[$i]['images'] = $pet[$i]->images;
                        $user->pets[$i]['specie'] = $pet[$i]->specie ? $pet[$i]->specie->name : null;
                        $user->pets[$i]['race'] = $pet[$i]->race ? $pet[$i]->race->name : null;
                        $user->pets[$i]['fur'] = $pet[$i]->fur ? $pet[$i]->fur->name : null;
                    }

                    DB::commit();
                    return response()->json([
                        'type' => 'success',
                        'title' => __('Update data done successfully'),
                        'message' => __('Pet updated successfully'),
                        'user' => $user
                    ], 200);
                } catch (\Throwable $th) {
                    return response()->json([
                        'type' => 'error',
                        'title' => __('Error in update data'),
                        'message' => __('Something went wrong')
                    ], 500);
                }
            } else {
                return response()->json([
                    'type' => 'error',
                    'title' => __('Error in update data'),
                    'message' => __('Pet not found')
                ], 404);
            }
        } else {
            return response()->json([
                'type' => 'error',
                'title' => __('Error in update data'),
                'message' => __('You are not authorized to update that profile')
            ], 401);
        }
    }

    public function reportPet(Request $request)
    {
        $input = $request->all();

        DB::beginTransaction();


        try {

            $location = isset($input['location']) ? json_decode($input['location']) : null;
            $user_ = isset($input['user']) ? json_decode($input['user']) : null;
            $pet_ = isset($input['pet']) ? json_decode($input['pet']) : null;

            $newUser['user_id'] = $user_->user_id ?? '';
            $newUser['phone'] = $user_->phone ?? '';
            $newUser['email'] = $user_->email ?? '';
            $newUser['name'] = $user_->name ?? '';
            $newUser['last_name1'] = $user_->last_name1 ?? '';
            $newUser['last_name2'] = $user_->last_name2 ?? '';
            $newUser['id_province'] = $user_->province->id ?? '';
            $newUser['id_canton'] = $user_->canton->id ?? '';
            $newUser['profile_photo_path'] = generateProfilePhotoPath($newUser['name']);


            $user = User::where('user_id', $newUser['user_id'])
                ->orWhere('phone', $newUser['phone'])
                ->orWhere('email', $newUser['email'])
                ->first();


            if ($user) {
                $pet['user_id'] = $user->user_id; //usuario existente
            } else {
                $newUser['password'] = Hash::make($newUser['user_id']);
                $newUser['api_token'] = Str::random(25);
                $pet['user_id'] = $newUser['user_id'];
                try {
                    validateUserID($newUser['user_id']);
                } catch (Exception $e) {
                    return response()->json([
                        'type' => 'error',
                        'title' => __('Error in create report'),
                        'message' => __('CI/RUC is invalid')
                    ], 500);
                }
                User::create($newUser);
                DB::commit();
            }

            $pet['name'] = ucwords(strtolower($pet_->name ?? ''));
            $pet['birth'] = $pet_->birth ?? date('Y-m-d');
            $pet['sex'] = $pet_->sex;
            $pet['castrated'] = $pet_->castrated;
            $pet['id_specie'] = $pet_->specie->id;
            $pet['id_race'] = $pet_->race->id;
            $pet['characteristic'] = $pet_->characteristic;

            $pet['pet_id'] = genaretePetId($pet); //Last ID
            $pet['lost'] = true;
            $pet['published'] = true;
            $pet['n_lost'] = 1;

            $report['latitude'] = $location->latitude ?? null;
            $report['longitude'] = $location->longitude ?? null;
            $report['active'] = true;
            $report['pet_id'] = $pet['pet_id'];
            $report['user_id'] = $user_->responsable ?? null;
            $report['created_at'] = date('Y-m-d H:i:s');
            $report['updated_at'] = date('Y-m-d H:i:s');

            Pet::create($pet);
            if ($request->hasFile('images'))
                uploadImage($input['images'], $pet['pet_id']);

            Report::create($report);
            DB::commit();
            return response()->json([
                'type' => 'success',
                'title' => __('Report done successfully'),
                'message' => __('At home slide to refresh the reports')
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'type' => 'error',
                'title' => __('Error in create report'),
                'message' => __('Try again')
            ], 500);
        }
    }

    public function getSelects()
    {
        try {

            $furs = Fur::orderBy('name', 'asc')->select('id', 'name')->get();
            $furs = $furs->map(function ($fur) {
                $fur->id_specie = $fur->species->pluck('id')->toArray();
                unset($fur->species);
                return $fur;
            });

            $selects = [
                'species' => Specie::orderBy('name', 'asc')->select('id', 'name')->get(),
                'races' => Race::orderBy('name', 'asc')->select('id', 'name', 'id_specie')->get(),
                'furs' => $furs,
                'provinces' => Province::orderBy('name', 'asc')->select('id', 'name')->get(),
                'cantons' => Canton::orderBy('name', 'asc')->select('id', 'name', 'id_province')->get(),
                'parishes' => Parish::orderBy('name', 'asc')->select('id', 'name', 'id_canton')->get(),
            ];

            return response()->json(['message' => 'Selects loaded', 'data' => $selects], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Something went error...', 'data' => []], 500);
        }
    }

    public function getAllPetsLostBySpecie($id)
    {
        try {

            $pets = Pet::with(['reports' => function ($query) {
                $query->where('active', true)->get();
            }])->where('id_specie', $id)
                ->where('published', true)
                ->where('lost', true)
                ->orderBy('created_at', 'asc')
                ->paginate(50);

            foreach ($pets as $pet) {
                $pet['specie_name'] = $pet->specie ? $pet->specie->name : null;
                $pet['specie_image'] = $pet->specie->image->url ?? null;
                $pet['race_name'] = $pet->race ? $pet->race->name : null;
                $pet['fur_name'] = $pet->fur ? $pet->fur->name : null;
                $pet['images'] = $pet->images;
                $pet['user'] = $pet->user;
                $pet['report'] = count($pet['reports']) ? $pet['reports'][count($pet['reports']) - 1] : null;
                $pet['report_date'] = $pet['report'] ? $pet['report']->created_at : null;
                unset($pet['reports']);
                unset($pet['specie']);
                unset($pet['race']);
                unset($pet['fur']);
            }

            return response()->json(['message' => 'Pets loaded', 'pets' =>  $pets], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Something went error...', 'data' => []], 500);
        }
    }

    public function getAllPetsLostByQuery($query)
    {
        try {

            $pets = Pet::with(['reports' => function ($query) {
                $query->where('active', true)->get();
            }])->where('published', true)
                ->where('lost', true)
                ->where('name', 'like', '%' . $query . '%')
                ->orWhere('pet_id', 'like', '%' . $query . '%')
                ->orderBy('created_at', 'asc')
                ->paginate(50);

            foreach ($pets as $pet) {
                $pet['specie_name'] = $pet->specie ? $pet->specie->name : null;
                $pet['specie_image'] = $pet->specie->image->url ?? null;
                $pet['race_name'] = $pet->race ? $pet->race->name : null;
                $pet['fur_name'] = $pet->fur ? $pet->fur->name : null;
                $pet['images'] = $pet->images;
                $pet['user'] = $pet->user;
                $pet['report'] = count($pet['reports']) ? $pet['reports'][count($pet['reports']) - 1] : null;
                $pet['report_date'] = $pet['report'] ? $pet['report']->created_at : null;
                unset($pet['reports']);
                unset($pet['specie']);
                unset($pet['race']);
                unset($pet['fur']);
            }

            return response()->json(['message' => 'Pets loaded', 'pets' =>  $pets], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Something went error...', 'data' => []], 500);
        }
    }

    public function getAllReports()
    {
        try {

            $reports = Report::with(['pet' => function ($query) {
                $query->with(['specie' => function ($query) {
                    $query->with(['image']);
                }]);
            }])->where('active', true)->orderBy('id', 'desc')->limit(100)->get();

            return response()->json(['message' => 'Reports ', 'reports' => $reports], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Something went error...', $th->getMessage()], 500);
        }
    }
}
