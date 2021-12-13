<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Canton;
use App\Models\Pet;
use App\Models\Province;
use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePetRequest;
use App\Http\Requests\UpdatePetRequest;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Storage; 


class ReportController extends Controller
{ 
    public function __construct(){
        $this->middleware('can:dashboard.reports.index')->only('index');
        $this->middleware('can:dashboard.reports.destroy')->only('destroy');
        /* $this->middleware('can:dashboard.reports.create')->only('create', 'store'); */
        $this->middleware('can:dashboard.reports.edit')->only('edit', 'update');
        $this->middleware('can:dashboard.destroyImageGoogle')->only('destroyImageGoogle'); 
    }
 
    public function index()
    {
        $pets = Pet::where('lost', true)->orderBy('updated_at', 'DESC')->get();
        return view('dashboard.reports.index', compact('pets'));
    }
 
    public function create()
    {
        $users = User::pluck('user_id', 'user_id');
        return view('dashboard.reports.create', compact('users'));
    }
 
    public function store(CreatePetRequest $request)
    {
        $input = $request->all();

        do {
            $input['pet_id'] = $this->genaretePetId($input);
        } while (Pet::where('pet_id', '==', $input['pet_id'])->first());


        DB::beginTransaction();
        try {
            Pet::create($input);
            
            DB::commit();                   
            return redirect()->route('dashboard.reports.index')->with('info', trans('lang.pet_created'));
        } catch (\Throwable $e) {
            DB::rollBack();            
            return redirect()->back()->with('error', trans('lang.pet_errpr') . $e->getMessage());
        } 

        dd($input);
    }
 
    public function show($id)
    {
        $pet = Pet::where('pet_id', $id)->first();
        $images = Image::where('pet_id', $id)->get();
        if(count($images)<=0) $images = [];
        $user = User::where('user_id', $pet->user_id)->first();
        $canton = null;
        $province = null;

        if($user){
            $canton = Canton::where('id', $user->id_canton)->first();
            $province = $canton ? Province::where('id', $canton->id_province)->first() : null;
        }
        return view('dashboard.reports.show', compact('pet', 'user', 'canton','province', 'images'));
    }
 
    public function edit($id)
    {
        $pet = Pet::where('pet_id', $id)->first();
        $users = User::pluck('user_id', 'user_id');
        $images = Image::where('pet_id', $pet->pet_id)->get(); 
        if(count($images)<=0) $images = [];

        return view('dashboard.reports.edit', compact('pet', 'users', 'images'));
    }
 
    public function update(UpdatePetRequest $request, Pet $pet)
    {
        $input = $request->all();
        $input['user_id'] = $input['users'] ? $input['users'] : null;

        $petUpdated = Pet::where('pet_id', $input['pet_id'])->first();

        DB::beginTransaction();
        try {

            if(!$petUpdated->published && $input['published']){
                 
            }

            $petUpdated->update($input);
            
            DB::commit();                   
            return redirect()->route('dashboard.reports.index')->with('info', trans('lang.pet_updated'));
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
            return redirect()->route('dashboard.reports.index')->with('info', trans('lang.pet_deleted'));
        } catch (\Throwable $e) {
            DB::rollBack();            
            return redirect()->back()->with('error', trans('lang.user_error'));
        } 
    }
    public function destroyImageGoogle (Request $request){
        $input = $request->all();
        
        try {
            DB::beginTransaction();            
            $imagePet = Image::where('url', $input['url'])->first();            
            Storage::disk("google")->delete($imagePet->id_image);
            $imagePet->delete();       
            DB::commit();
            return redirect()->back()->with('info', trans('lang.image_pet_reporte_deleted'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', trans('lang.user_error'));
        } 
    }
}
