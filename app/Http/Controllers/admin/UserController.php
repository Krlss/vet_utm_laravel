<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdatePetRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Canton;
use App\Models\Parish;
use App\Models\Pet;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:dashboard.users.index')->only('index');
        $this->middleware('can:dashboard.users.destroy')->only('destroy');
        $this->middleware('can:dashboard.users.create')->only('create');
        $this->middleware('can:dashboard.users.edit')->only('edit');
    }

    public function index()
    {

        $users = User::orderBy('updated_at', 'DESC')->get();

        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        $provinces = Province::pluck('name', 'id');
        $roles = Role::pluck('name', 'id');
        $cantons = [];
        $parishes = [];
        return view('dashboard.users.create', compact('provinces', 'cantons', 'roles', 'parishes'));
    }

    public function store(CreateUserRequest $request)
    {
        $input = $request->all();

        $password = $input['user_id'];

        $input['password'] = Hash::make($password);
        $input['api_token'] = Str::random(25);
        $input['email_verified_at'] = null;

        DB::beginTransaction();
        try {
            User::create($input)->assignRole($request['roles']);

            DB::commit();
            return redirect()->route('dashboard.users.index')->with('info', trans('lang.user_created'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', trans('lang.user_error'));
        }
    }

    public function show(User $user)
    {

        $pets = Pet::where('user_id', $user->user_id)->get();

        $parish = Parish::where('id', $user->id_parish)->first();

        $canton = Canton::where('id', $user->id_canton)->first();

        $province = Province::where('id', $user->id_province)->first();

        return view('dashboard.users.show', compact('pets', 'user', 'canton', 'province', 'parish'));
    }

    public function edit(User $user)
    {
        $pets = Pet::where('user_id', $user->user_id)->get();

        $parish = Parish::where('id', $user->id_parish)->first();

        $canton = Canton::where('id', $user->id_canton)->first();

        $province = Province::where('id', $user->id_province)->first();

        $provinces = Province::pluck('name', 'id');

        $cantons = [];

        $parishes = [];

        $roles = Role::pluck('name', 'id');

        return view('dashboard.users.edit', compact('pets', 'user', 'canton', 'province', 'provinces', 'cantons', 'roles', 'parish', 'parishes'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $input = $request->all();

        DB::beginTransaction();
        try {
            $user->roles()->sync($request['roles']);
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
        DB::beginTransaction();
        try {

            $user->delete();
            DB::commit();
            return redirect()->route('dashboard.users.index')->with('info', trans('lang.user_deleted'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', trans('lang.user_error'));
        }
    }

    public function getUserToPet(Request $request)
    {
        $input = $request->all();

        try {
            $users = User::where('user_id', 'like', '%' . $input['search'] . '%')->select('user_id', 'user_id')->get()->take(25);
            return response()->json($users);
        } catch (\Throwable $e) {
            return null;
        }
    }
}
