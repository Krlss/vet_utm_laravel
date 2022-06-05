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
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $this->middleware('can:dashboard.users.show')->only('show');
        $this->middleware('can:dashboard.users.create')->only('create', 'store');
        $this->middleware('can:dashboard.users.edit')->only('edit', 'update');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('users.*');
            return DataTables()->of($data)
                ->addColumn('lastnames', function ($user) {
                    return $user->last_name1 . ' ' . $user->last_name2;
                })
                ->editColumn('updated_at', function ($user) {
                    $date = date_create($user->updated_at);
                    return date_format($date, "d/m/Y");
                })
                ->addColumn('actions', function ($user) {
                    return view('dashboard.users.partials.actions', compact('user'));
                })
                ->make(true);
        }

        $users = [];
        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        $provinces = Province::pluck('name', 'id');
        $roles = Role::pluck('name', 'id');
        $cantons = [];
        $parishes = [];

        $pets = [];
        $petsSelected = [];

        $lettersAvailable = [];

        if (Auth::user()->hasPermissionTo('dashboard.cantons.create')) {
            $lettersAvailable = getLettersAvailable();
        }

        return view('dashboard.users.create', compact('provinces', 'cantons', 'roles', 'parishes', 'pets', 'petsSelected', 'lettersAvailable'));
    }

    public function store(CreateUserRequest $request)
    {
        $input = $request->all();

        $password = $input['user_id'];

        $input['password'] = Hash::make($password);
        $input['api_token'] = Str::random(25);
        $input['email_verified_at'] = null;
        $input['profile_photo_path'] = generateProfilePhotoPath($input['name']);


        try {
            validateUserID($input['user_id']);
        } catch (Exception $e) {
            return redirect()->back()->with('error', __('CI/RUC is invalid'))->withInput();
        }

        DB::beginTransaction();
        try {
            if (isset($input['name']))  $input['name'] = ucwords(strtolower($input['name']));
            if (isset($input['last_name1']))  $input['last_name1'] = ucwords(strtolower($input['last_name1']));
            if (isset($input['last_name2']))  $input['last_name2'] = ucwords(strtolower($input['last_name2']));
            $user = User::create($input)->assignRole($request['roles']);

            if (isset($input['pets'])) {
                $pets = $input['pets'];
                unset($input['pets']);

                foreach ($pets as $pet) {
                    Pet::where('pet_id', $pet)->update(['user_id' => $input['user_id']]);
                }
            }


            DB::commit();
            return redirect()->route('dashboard.users.show', $user)->with('success', __('User created successfully'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', __('Error creating user') . ' ' . $e->getMessage())->withInput();
        }
    }

    public function show(User $user)
    {
        return view('dashboard.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $provinces = Province::pluck('name', 'id');

        $cantons = [];

        $parishes = [];

        $roles = Role::pluck('name', 'id');

        $pets = $user->pets ? $user->pets->pluck('pet_id', 'pet_id') : [];

        $petsSelected = is_null($pets) ? [] : $pets->all();

        $lettersAvailable = [];

        if (Auth::user()->hasPermissionTo('dashboard.cantons.create')) {
            $lettersAvailable = getLettersAvailable();
        }

        return view('dashboard.users.edit', compact('user', 'provinces', 'cantons', 'roles', 'parishes', 'petsSelected', 'pets', 'lettersAvailable'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $input = $request->all();

        try {
            validateUserID($input['user_id']);
        } catch (Exception $e) {
            return redirect()->back()->with('error', __('CI/RUC is invalid'))->withInput();
        }

        DB::beginTransaction();
        try {

            if (isset($request['roles'])) $user->roles()->sync($request['roles']);

            //All pets this current user!
            $pets_exist = Pet::where('user_id', $user->user_id)->pluck('pet_id');
            if (isset($input['name']))  $input['name'] = ucwords(strtolower($input['name']));
            if (isset($input['last_name1']))  $input['last_name1'] = ucwords(strtolower($input['last_name1']));
            if (isset($input['last_name2']))  $input['last_name2'] = ucwords(strtolower($input['last_name2']));

            foreach ($pets_exist as $current) {
                $exist = null;
                if (isset($input['pets']))
                    $exist = array_search($current, $input['pets']);
                if (is_numeric($exist)) {
                    continue;
                } else {
                    Pet::where('pet_id', $current)->update(['user_id' => null]);
                }
            }
            if (isset($input['pets']))
                foreach ($input['pets'] as $new_pet) {
                    $exist = array_search($new_pet, $pets_exist->all());
                    if (is_numeric($exist)) {
                        continue;
                    } else {
                        Pet::where('pet_id', $new_pet)->update(['user_id' => $input['user_id']]);
                    }
                }

            $user->update($input);

            DB::commit();
            return redirect()->route('dashboard.users.show', $user)->with('success', __('User updated successfully'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', __('Error updating user') . ' ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {

            $user->delete();
            DB::commit();
            return redirect()->route('dashboard.users.index')->with('success', __('User deleted successfully'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', __('Error deleting user') . ' ' . $e->getMessage());
        }
    }

    public function getUserToPet(Request $request)
    {
        $input = $request->all();

        try {
            $users = User::where('user_id', 'like', '%' . $input['search'] . '%')
                ->orWhere('name', 'LIKE', '%' .  ucwords(strtolower($input['search'])) . '%')
                ->orWhere('last_name1', 'LIKE', '%' .  ucwords(strtolower($input['search'])) . '%')
                ->orWhere('last_name2', 'LIKE', '%' .  ucwords(strtolower($input['search'])) . '%')
                ->select('name', 'last_name1', 'last_name2', 'user_id')->get()->take(25);
            return response()->json($users);
        } catch (\Throwable $e) {
            return null;
        }
    }
}
