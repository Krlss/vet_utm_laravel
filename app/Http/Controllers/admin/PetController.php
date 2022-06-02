<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePetRequest;
use App\Http\Requests\UpdatePetRequest;
use App\Models\Canton;
use App\Models\Fur;
use App\Models\Image;
use App\Models\Parish;
use App\Models\Pet;
use App\Models\Province;
use App\Models\Race;
use App\Models\Specie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PetController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:dashboard.pets.index')->only('index');
        $this->middleware('can:dashboard.pets.destroy')->only('destroy');
        $this->middleware('can:dashboard.pets.show')->only('show');
        $this->middleware('can:dashboard.pets.create')->only('create', 'store');
        $this->middleware('can:dashboard.pets.edit')->only('edit', 'update');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pet::all();
            return DataTables()->of($data)
                ->editColumn('user', function ($pet) {
                    return $pet->user ? $pet->user->user_id : __('Owner undefined');
                })
                ->editColumn('specie', function ($pet) {
                    return $pet->specie ? $pet->specie->name : __('Specie undefined');
                })
                ->editColumn('castrated', function ($pet) {
                    return $pet->castrated ? __('Yes') : __('No');
                })
                ->editColumn('lost', function ($pet) {
                    return $pet->lost ? __('Yes') : __('No');
                })
                ->editColumn('updated_at', function ($pet) {
                    $date = date_create($pet->updated_at);
                    return date_format($date, "d/m/Y");
                })
                ->addColumn('actions', function ($pet) {
                    return view('dashboard.pets.partials.actions', compact('pet'));
                })
                ->make(true);
        }

        $pets = [];

        return view('dashboard.pets.index', compact('pets'));
    }

    public function create()
    {
        $users = User::pluck('user_id', 'user_id');
        $pets = Pet::all();
        $father = $pets->where('sex', 'M')
            ->pluck('pet_id', 'pet_id');
        $mother = $pets->where('sex', 'F')
            ->pluck('pet_id', 'pet_id');

        $childrens = [];
        $childrensSelected = [];

        $species = Specie::orderBy('name', 'asc')->pluck('name', 'id');
        $races = [];

        $furs = Fur::orderBy('name', 'asc')->pluck('name', 'id');

        return view('dashboard.pets.create', compact('users', 'pets', 'childrens', 'childrensSelected', 'species', 'races', 'furs'))->with('pather', $father)->with('mother', $mother);
    }

    public function store(CreatePetRequest $request)
    {
        $input = $request->all();

        $input['pet_id'] = genaretePetId($input);

        //1 if created as lost
        $input['n_lost'] = $input['lost'] ? 1 : 0;

        if (isset($input['pather'])) $input['id_pet_pather'] = $input['pather'] == 'null' ? null : $input['pather'];
        unset($input['pather']);

        if (isset($input['mother'])) $input['id_pet_mother'] = $input['mother'] == 'null' ? null : $input['mother'];
        unset($input['mother']);

        if (isset($input['name'])) $input['name'] = ucwords(strtolower($input['name']));

        DB::beginTransaction();
        try {
            $pet = Pet::create($input);

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

            if ($request->hasFile('images')) {
                $request->validate([
                    'images*' => 'image|mimes:jpg,png,jpeg,webp,svg'
                ]);
                uploadImagesDashboard($request->file('images'), $input['pet_id']);
            }

            DB::commit();
            return redirect()->route('dashboard.pets.show', $pet)->with('success', __('Pet created successfully'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', __('Error creating pet') . ' ' . $e->getMessage())->withInput();
        }
    }

    public function show(Pet $pet)
    {

        $childs = Pet::where('id_pet_pather', $pet->pet_id)
            ->orWhere('id_pet_mother', $pet->pet_id)
            ->get();

        return view('dashboard.pets.show', compact('pet', 'childs'));
    }

    public function edit(Pet $pet)
    {

        $users = User::pluck('user_id', 'user_id');
        $pets = Pet::all();

        $pather = $pets->where('sex', 'M')->where('id_specie', $pet->id_specie)->pluck('pet_id', 'pet_id');
        $mother = $pets->where('sex', 'F')->where('id_specie', $pet->id_specie)->pluck('pet_id', 'pet_id');

        $childs = Pet::where('id_pet_pather', $pet->pet_id)
            ->orWhere('id_pet_mother', $pet->pet_id)
            ->get();

        $childrens =  $childs->pluck('pet_id', 'pet_id');

        $childrensSelected = is_null($childrens) ? [] : $childrens->all();

        $images_ = $pet->images()->select('id_image', 'name', 'url')->get()->toArray();

        $species = Specie::orderBy('name', 'asc')->pluck('name', 'id');
        $furs = Fur::orderBy('name', 'asc')->pluck('name', 'id');
        $races = Race::where('id_specie', $pet->id_specie)->orderBy('name', 'asc')->pluck('name', 'id');

        return view('dashboard.pets.edit', compact('pet', 'users', 'pather', 'mother', 'childrens', 'childrensSelected', 'images_', 'childs', 'species', 'races', 'furs'));
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
            sendNotificationEmailToPetLost($pet);
        }

        if (isset($input['name'])) $input['name'] = ucwords(strtolower($input['name']));

        DB::beginTransaction();
        try {
            if ($request->hasFile('images')) {
                $request->validate([
                    'images*' => 'image|mimes:jpg,png,jpeg,webp,svg'
                ]);
                uploadImagesDashboard($request->file('images'), $pet->pet_id);
            } else {
                //Ahora eliminamos las imagenes si llega a tener, porque desde la vista no nos envían imagenes...
                $imagesCurrent = $pet->images;
                foreach ($imagesCurrent as $imgC) {
                    Storage::disk("google")->delete($imgC->id_image);
                    $imgC->delete();
                }
            }

            if (isset($input['pet_id'])) $input['pet_id'] = strtoupper($input['pet_id']);

            if (isset($input['childrens'])) {

                $childrendsCurrent = Pet::where('id_pet_pather', $pet->pet_id)
                    ->orWhere('id_pet_mother', $pet->pet_id)
                    ->get();

                foreach ($childrendsCurrent as $childrendsC) {
                    $exist = array_search($childrendsC->pet_id, $input['childrens']);
                    if (is_numeric($exist)) {
                        continue;
                    } else {
                        if ($pet->sex == 'M') {
                            $childrendsC->update(['id_pet_pather', null]);
                        } elseif ($pet->sex == 'F') {
                            $childrendsC->update(['id_pet_mother' => null]);
                        }
                    }
                }

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

            $pet->update($input);

            DB::commit();
            return redirect()->route('dashboard.pets.show', $pet)->with('success', __('Pet updated successfully'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', __('Error updating pet') . ' ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Pet $pet)
    {
        DB::beginTransaction();
        try {
            $imagesCurrent = $pet->images;
            foreach ($imagesCurrent as $imgC) {
                Storage::disk("google")->delete($imgC->id_image);
                $imgC->delete();
            }
            $pet->delete();
            DB::commit();
            return redirect()->route('dashboard.pets.index')->with('success', __('Pet deleted successfully'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', __('Error deleting pet') . ' ' . $e->getMessage());
        }
    }

    public function getParents(Request $request)
    {
        try {
            $input = $request->all();

            if (isset($input['childrensSeleted'])) {
                $result = Pet::where('id_specie', $input['specie'])
                    ->where(function ($query) use ($input) {
                        $query->where('name', 'LIKE', '%' .  ucwords(strtolower($input['search'])) . '%')
                            ->orWhere('pet_id', 'LIKE', '%' . strtoupper($input['search']) . '%');
                    })
                    ->where('sex', $input['sex'])
                    ->where('pet_id', '<>', $input['pet_id'])
                    ->whereNotIn('pet_id', $input['childrensSeleted'])
                    ->select('name', 'pet_id')->get()->take(25);
            } else {
                $result = Pet::where('id_specie', $input['specie'])
                    ->where(function ($query) use ($input) {
                        $query->where('name', 'LIKE', '%' .  ucwords(strtolower($input['search'])) . '%')
                            ->orWhere('pet_id', 'LIKE', '%' . strtoupper($input['search']) . '%');
                    })
                    ->where('sex', $input['sex'])
                    ->where('pet_id', '<>', $input['pet_id'])
                    ->select('name', 'pet_id')->get()->take(25);
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

            return redirect()->back()->with('success', __('Pet deleted to user successfully'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', __('Error deleting pet to user') . ' ' . $e->getMessage());
        }
    }

    public function deletePetToChildren(Request $request)
    {

        $input = $request->all();

        $pet = Pet::where('pet_id', $input['pet_id'])->first();

        try {
            DB::beginTransaction();

            if ($input['sex'] == 'F') {
                $pet->id_pet_mother = null;
            }
            if ($input['sex'] == 'M') {
                $pet->id_pet_pather = null;
            }
            $pet->save();

            DB::commit();

            return redirect()->back()->with('success', __('Child deleted to pet successfully'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', __('"Error deleting child to pet') . ' ' . $e->getMessage());
        }
    }

    public function getChildrensToPet(Request $request)
    {
        try {

            $input = $request->all();

            $pets = Pet::where('id_pet_pather', $input['pet_id'])
                ->orWhere('id_pet_mother', $input['pet_id'])
                ->pluck('pet_id');
            $result = ['pets' => $pets];
            return response()->json($result);
        } catch (\Throwable $e) {
            return response()->json([]);
        }
    }

    public function getPetsWithoutOwner(Request $request)
    {
        try {
            $input = $request->all();

            $pets  = Pet::where('user_id', '=', null)
                ->where(function ($query) use ($input) {
                    $query->where('name', 'LIKE', '%' .  ucwords(strtolower($input['search'])) . '%')
                        ->orWhere('pet_id', 'LIKE', '%' . strtoupper($input['search']) . '%');
                })->select('name', 'pet_id')->get()->take(25);

            $result = ['pets' => $pets];
            return response()->json($result);
        } catch (\Throwable $th) {
            return json_encode(['pets' => []]);
        }
    }

    public function getChildrens(Request $request)
    {
        try {
            $input = $request->all();
            /* No puedes ser padre y madre a la ves, dependiendo del sexo que se envie buscará en la columna de la base
            de datos para ver si ese campo está nulo, así solo se podra tener un padre o una madre */
            $is_null_parent = $input['sex'] == 'F' ? 'id_pet_mother' : 'id_pet_pather';
            if ($input['sex'] == null) $is_null_parent = null;

            if ($is_null_parent) {
                $pets = Pet::where('id_specie', $input['specie'])
                    ->where(function ($query) use ($input) {
                        $query->where('name', 'LIKE', '%' .  ucwords(strtolower($input['search'])) . '%')
                            ->orWhere('pet_id', 'LIKE', '%' . strtoupper($input['search']) . '%');
                    })
                    ->where('pet_id', '<>', $input['pather_seleted'])
                    ->where('pet_id', '<>', $input['mother_seleted'])
                    ->where('pet_id', '<>', $input['pet_id'])
                    ->where($is_null_parent, null)
                    ->select('name', 'pet_id')->get()->take(25);
            } else {
                $pets = Pet::where('id_specie', $input['specie'])
                    ->where(function ($query) use ($input) {
                        $query->where('name', 'LIKE', '%' .  ucwords(strtolower($input['search'])) . '%')
                            ->orWhere('pet_id', 'LIKE', '%' . strtoupper($input['search']) . '%');
                    })
                    ->where('pet_id', '<>', $input['pather_seleted'])
                    ->where('pet_id', '<>', $input['mother_seleted'])
                    ->where('pet_id', '<>', $input['pet_id'])
                    ->select('name', 'pet_id')->get()->take(25);
            }

            $result = ['pets' => $pets];
            return response()->json($result);
        } catch (\Throwable $th) {
            return json_encode(['Childrens' => []]);
        }
    }
}
