<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Canton;
use App\Models\Province;
use App\Models\User; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {

        $users = User::orderBy('updated_at', 'DESC')->get();

        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        $provinces = Province::pluck('name', 'id'); 
        $cantons = [];
        $province = null;
        $canton = null;
        return view('dashboard.users.create', compact('provinces', 'cantons', 'province', 'canton'));
    }

    public function store(CreateUserRequest $request)
    {
        $input = $request->all(); 

        $password = $input['user_id'];

        $input['password'] = Hash::make($password);
        
        DB::beginTransaction();
        try {
            User::create($input);
            
            DB::commit();                   
            return redirect()->route('dashboard.users.index')->with('info', trans('lang.user_created'));
        } catch (\Throwable $e) {
            DB::rollBack();            
            return redirect()->back()->with('error', trans('lang.user_error'));
        } 
    }

    public function show(User $user)
    {   
        $pets = $user->pets()->where('user_id', $user->user_id)->get();
        
        $canton = Canton::where('id', $user->id_canton)->first(); 

        $province = Province::where('id', $canton->id_province)->first();
        
        return view('dashboard.users.show', compact('pets', 'user', 'canton', 'province'));
    }

    public function edit(User $user)
    {
        $pets = $user->pets()->where('user_id', $user->user_id)->get();
        
        $canton = Canton::where('id', $user->id_canton)->first(); 

        $province = Province::where('id', $canton->id_province)->first();

        $provinces = Province::pluck('name', 'id');

        $cantons = []; 
        
        return view('dashboard.users.edit', compact('pets', 'user', 'canton', 'province','provinces', 'cantons'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $input = $request->all();

        DB::beginTransaction();
        try {
            $user->update($input);
            
            DB::commit();                   
            return redirect()->route('dashboard.users.index')->with('info', trans('lang.user_updated'));
        } catch (\Throwable $e) {
            DB::rollBack();            
            return redirect()->back()->with('error', trans('lang.user_error'));
        } 
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('dashboard.users.index')->with('info', trans('lang.user_deleted'));
    }
}
