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
    public function __construct()
    {
        $this->middleware('can:dashboard.pets.index')->only('index');
        $this->middleware('can:dashboard.pets.destroy')->only('destroy');
        $this->middleware('can:dashboard.pets.create')->only('create', 'store');
        $this->middleware('can:dashboard.pets.edit')->only('edit', 'update');
    }

    public function index()
    {
        $pets = Pet::orderBy('updated_at', 'DESC')->get();
        return view('dashboard.pets.index', compact('pets'));
    }

    public function create()
    {
        $users = User::pluck('user_id', 'user_id');
        $pets = Pet::all();
        $father = $pets->where('sex', 'M')
            ->where('specie', 'canine')
            ->pluck('pet_id', 'pet_id');
        $mother = $pets->where('sex', 'F')
            ->where('specie', 'canine')
            ->pluck('pet_id', 'pet_id');

        $childrens = [];
        $childrensSelected = [];
        return view('dashboard.pets.create', compact('users', 'pets', 'childrens', 'childrensSelected'))->with('pather', $father)->with('mother', $mother);
    }

    public function store(CreatePetRequest $request)
    {
        $input = $request->all();

        do {
            $input['pet_id'] = $this->genaretePetId($input);
        } while (Pet::where('pet_id', '==', $input['pet_id'])->first());

        //1 if created as lost
        $input['n_lost'] = $input['lost'] ? 1 : 0;

        if (isset($input['pather'])) $input['id_pet_pather'] = $input['pather'] == 'null' ? null : $input['pather'];
        unset($input['pather']);

        if (isset($input['mother'])) $input['id_pet_mother'] = $input['mother'] == 'null' ? null : $input['mother'];
        unset($input['mother']);
        DB::beginTransaction();
        try {
            Pet::create($input);

            if (isset($input['childrens'])) {
                $childrens = $input['childrens'];
                unset($input['childrens']);

                foreach ($childrens as $children) {
                    if ($input['sex'] == 'M') {
                        Pet::where('pet_id', $children)->update(['id_pet_pather' => $input['pet_id']]);
                    } elseif ($input['sex'] == 'F') {
                        Pet::where('pet_id', $children)->update(['id_pet_mother' => $input['pet_id']]);
                    }
                }
            }

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

        if ($user) {
            $canton = Canton::where('id', $user->id_canton)->first();
            $province = $canton ? Province::where('id', $canton->id_province)->first() : null;
        }

        $childs = Pet::where('id_pet_pather', $pet->pet_id)
            ->orWhere('id_pet_mother', $pet->pet_id)
            ->get();

        return view('dashboard.pets.show', compact('pet', 'user', 'canton', 'province', 'childs'));
    }

    public function edit(Pet $pet)
    {

        $users = User::pluck('user_id', 'user_id');
        $pets = Pet::all();

        $pather = $pets->where('sex', 'M')->where('specie', $pet->specie)->pluck('pet_id', 'pet_id');
        $mother = $pets->where('sex', 'F')->where('specie', $pet->specie)->pluck('pet_id', 'pet_id');

        return view('dashboard.pets.edit', compact('pet', 'users', 'pather', 'mother'));
    }

    public function update(UpdatePetRequest $request, Pet $pet)
    {
        $input = $request->all();

        if (isset($input['pather'])) $input['id_pet_pather'] = $input['pather'] == 'null' ? null : $input['pather'];
        unset($input['pather']);

        if (isset($input['mother'])) $input['id_pet_mother'] = $input['mother'] == 'null' ? null : $input['mother'];
        unset($input['mother']);

        //if it changes from false to true
        if (!$pet->lost && $input['lost']) {
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


    public function genaretePetId($input)
    {

        /* FIRST letter of province + secuencial two letter a-z more secuencial number 001-999*/
        /* MAA-001 */
        /* MZZ-999 */




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

    public function getParents(Request $request)
    {
        try {
            $input = $request->all();

            if (isset($input['childrensSeleted'])) {
                $result = Pet::where('specie', $input['specie'])
                    ->where('pet_id', 'like', '%' . strtoupper($input['search']) . '%')
                    ->where('sex', $input['sex'])
                    ->whereNotIn('pet_id', $input['childrensSeleted'])
                    ->select('pet_id', 'pet_id')->get()->take(25);
            } else {
                $result = Pet::where('specie', $input['specie'])
                    ->where('pet_id', 'like', '%' . strtoupper($input['search']) . '%')
                    ->where('sex', $input['sex'])
                    ->select('pet_id', 'pet_id')->get()->take(25);
            }

            return response()->json($result);
        } catch (\Throwable $e) {
            return json_encode(['Parents' => []]);
        }
    }

    public function deletePetToUser(Request $request)
    {
        $input = $request->all();

        $pet = Pet::where('pet_id', $input['pet_id'])->first();

        try {
            DB::beginTransaction();

            $pet->user_id = null;
            $pet->save();

            DB::commit();

            return redirect()->back()->with('info', trans('lang.pet_user_delete'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', trans('lang.user_error'));
        }
    }

    public function getChildrens(Request $request)
    {
        try {
            $input = $request->all();

            $is_null_parent = $input['sex'] == 'F' ? 'id_pet_mother' : 'id_pet_pather';
            if ($input['sex'] == null) $is_null_parent = null;

            if ($is_null_parent) {
                $pets = Pet::where('specie', $input['specie'])
                    ->where('pet_id', 'like', '%' . strtoupper($input['search']) . '%')
                    ->where('pet_id', '<>', $input['pather_seleted'])
                    ->where('pet_id', '<>', $input['mother_seleted'])
                    ->where($is_null_parent, null)
                    ->select('pet_id', 'pet_id')->get()->take(25);
            } else {
                $pets = Pet::where('specie', $input['specie'])
                    ->where('pet_id', 'like', '%' . strtoupper($input['search']) . '%')
                    ->where('pet_id', '<>', $input['pather_seleted'])
                    ->where('pet_id', '<>', $input['mother_seleted'])
                    ->select('pet_id', 'pet_id')->get()->take(25);
            }

            $result = ['pets' => $pets];
            return response()->json($result);
        } catch (\Throwable $th) {
            return json_encode(['Childrens' => []]);
        }
    }
}
