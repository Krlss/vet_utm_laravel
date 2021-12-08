<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePetRequest;
use App\Http\Requests\UpdatePetRequest;
use App\Models\Canton;
use App\Models\Pet;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetController extends Controller
{
 
    public function index()
    {
        $pets = Pet::orderBy('updated_at', 'DESC')->get();
        return view('dashboard.pets.index', compact('pets'));
    }
 
    public function create()
    {
        $users = User::pluck('user_id', 'user_id');
        return view('dashboard.pets.create', compact('users'));
    }
 
    public function store(CreatePetRequest $request)
    {
        $input = $request->all();

        do {
            $input['pet_id'] = $this->genaretePetId($input);
        } while (Pet::where('pet_id', '==', $input['pet_id'])->first());
        
        //1 if created as lost
        $input['n_lost'] = $input['lost'] ? 1 : 0;

        DB::beginTransaction();
        try {
            Pet::create($input);
            
            DB::commit();                   
            return redirect()->route('dashboard.pets.index')->with('info', trans('lang.pet_created'));
        } catch (\Throwable $e) {
            DB::rollBack();            
            return redirect()->back()->with('error', trans('lang.pet_errpr') . $e->getMessage());
        } 

        dd($input);
    }
 
    public function show(Pet $pet)
    {
        $user = User::where('user_id', $pet->user_id)->first();
        $canton = null;
        $province = null;

        if($user){
            $canton = Canton::where('id', $user->id_canton)->first();
            $province = $canton ? Province::where('id', $canton->id_province)->first() : null;
        }
        return view('dashboard.pets.show', compact('pet', 'user', 'canton','province'));
    }
 
    public function edit(Pet $pet)
    {

        $users = User::pluck('user_id', 'user_id');

        return view('dashboard.pets.edit', compact('pet', 'users'));
    }
 
    public function update(UpdatePetRequest $request, Pet $pet)
    {
        $input = $request->all();
        $input['user_id'] = $input['users'];
        
        //if it changes from false to true
        if(!$pet->lost && $input['lost']){
            $input['n_lost'] = $pet->n_lost + 1;
        }

        DB::beginTransaction();
        try {
            $pet->update($input);
            
            DB::commit();                   
            return redirect()->route('dashboard.pets.index')->with('info', trans('lang.pet_updated'));
        } catch (\Throwable $e) {
            DB::rollBack();            
            return redirect()->back()->with('error', trans('lang.user_error'));
        } 
    }
 
    public function destroy(Pet $pet)
    {
        DB::beginTransaction();
        try {
            
        $pet->delete();
        DB::commit();
        return redirect()->route('dashboard.pets.index')->with('info', trans('lang.pet_deleted'));
    } catch (\Throwable $e) {
        DB::rollBack();            
        return redirect()->back()->with('error', trans('lang.user_error'));
    } 
    }


    public function genaretePetId($input){
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
}
