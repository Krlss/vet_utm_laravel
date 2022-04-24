<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePetRequest;
use App\Http\Requests\UpdatePetRequest;
use App\Models\Canton;
use App\Models\Image;
use App\Models\Parish;
use App\Models\Pet;
use App\Models\Province;
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

        if (isset($input['name'])) $input['name'] = ucwords(strtolower($input['name']));

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

            if ($request->hasFile('images')) {
                $request->validate([
                    'images*' => 'image|mimes:jpg,png,jpeg,webp,svg'
                ]);
                $this->uploadImages($request->file('images'), $input['pet_id'], false);
            }

            DB::commit();
            return redirect()->route('dashboard.pets.index')->with('info', trans('lang.pet_created'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', trans('lang.pet_errpr') . $e->getMessage());
        }
    }

    public function uploadImages($files, $pet_id, $updated)
    {
        try {

            //Imagenes que le llegan 
            $filesCurrent = [];

            //Imagenes de la base de datos
            $imagesCurrent = Image::where('pet_id', $pet_id)->get();

            if ($imagesCurrent) {
                foreach ($files as $file) {
                    $file_['name'] = $file->getClientOriginalName();
                    $file_['ext'] = $file->getClientOriginalExtension();
                    array_push($filesCurrent, $file_);
                };
                foreach ($imagesCurrent as $imgC) {
                    //Si la imagen de la base de datos se encuentra en las imagenes que le llegan
                    //no se elimina, si no se encuentra en las imagenes que llegan se elimina.
                    $exist = array_search($imgC->id_image, array_column($filesCurrent, 'name'));
                    if (is_numeric($exist)) {
                        continue;
                    } else {
                        Storage::disk("google")->delete($imgC->id_image);
                        $imgC->delete();
                    }
                }
            }

            foreach ($files as $file) {
                if ($file->getClientOriginalExtension() <> '') {
                    $filename = $file->getClientOriginalName();
                    Storage::disk("google")->put($filename, file_get_contents($file));
                    $urlGoogleImage = Storage::disk("google")->url($filename);
                    $urlG = explode('=', $urlGoogleImage);
                    $id_img = explode('&', $urlG[1]);

                    $image['id_image'] = $id_img[0];
                    $image['url'] = $urlGoogleImage;
                    $image['name'] = $filename;
                    $image['pet_id'] = $pet_id;

                    Image::create($image);
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function show(Pet $pet)
    {
        $user = User::where('user_id', $pet->user_id)->first();
        $canton = null;
        $province = null;
        $parish = null;

        if ($user) {
            $canton = Canton::where('id', $user->id_canton)->first();
            $province = Province::where('id', $user->id_province)->first();
            $parish = Parish::where('id', $user->id_parish)->first();
        }

        $childs = Pet::where('id_pet_pather', $pet->pet_id)
            ->orWhere('id_pet_mother', $pet->pet_id)
            ->get();

        $images = Image::where('pet_id', $pet->pet_id)->get();

        return view('dashboard.pets.show', compact('pet', 'user', 'canton', 'province', 'childs', 'parish', 'images'));
    }

    public function edit(Pet $pet)
    {

        $users = User::pluck('user_id', 'user_id');
        $pets = Pet::all();

        $pather = $pets->where('sex', 'M')->where('specie', $pet->specie)->pluck('pet_id', 'pet_id');
        $mother = $pets->where('sex', 'F')->where('specie', $pet->specie)->pluck('pet_id', 'pet_id');

        $childrens = Pet::where('id_pet_pather', $pet->pet_id)
            ->orWhere('id_pet_mother', $pet->pet_id)
            ->pluck('pet_id', 'pet_id');

        $childrensSelected = is_null($childrens) ? [] : $childrens->all();

        $images_ = Image::where('pet_id', $pet->pet_id)->select('id_image', 'name', 'url')->get()->toArray();

        return view('dashboard.pets.edit', compact('pet', 'users', 'pather', 'mother', 'childrens', 'childrensSelected', 'images_'));
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

        if (isset($input['name'])) $input['name'] = ucwords(strtolower($input['name']));

        DB::beginTransaction();
        try {
            if ($request->hasFile('images')) {
                $request->validate([
                    'images*' => 'image|mimes:jpg,png,jpeg,webp,svg'
                ]);
                $this->uploadImages($request->file('images'), $pet->pet_id, true);
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
            $imagesCurrent = Image::where('pet_id', $pet->pet_id)->get();
            foreach ($imagesCurrent as $imgC) {
                Storage::disk("google")->delete($imgC->id_image);
                $imgC->delete();
            }
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

        $ip = isset($_SERVER['HTTP_CLIENT_IP'])
            ? $_SERVER['HTTP_CLIENT_IP']
            : (isset($_SERVER['HTTP_X_FORWARDED_FOR'])
                ? $_SERVER['HTTP_X_FORWARDED_FOR']
                : $_SERVER['REMOTE_ADDR']);

        $url = "http://ip-api.com/json/" . $ip;
        $region = json_decode(file_get_contents($url));
        $letter_user = null;

        if ($region->status == "success") {
            $region = $region->region ? $region->region : 'D';
        } else {
            $region = 'D';
        }

        if ($input['user_id']) {
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
            $last_pet = strtoupper($region . $letters[0] . '-' . '001');
        } else {
            //pet_id convert to array ['MGF', '065];
            $array_petID = explode("-", $last_pet);

            //get number
            $num_int = intval($array_petID[1]);
            $new_num = '';

            $newCombination = '';
            $array_letter = [];

            if ($num_int == 999) {
                //get last combination for generate new
                $array_letter = explode($region, $array_petID[0]);

                for ($i = 0; $i < count($letters); $i++) {
                    //get next combination
                    if ($letters[$i] == $array_letter[1]) {
                        $newCombination = $letters[$i + 1];
                    }
                }
                $last_pet = strtoupper($region . $newCombination . "-" . '001');
            } else {
                $num_int = $num_int + 1;

                //get last combination
                $array_letter = explode($region, $array_petID[0]);

                if ($num_int < 10) $new_num = '00' . $num_int;
                elseif ($num_int < 100) $new_num = '0' . $num_int;
                else $new_num = '' . $new_num;

                $last_pet = strtoupper($region . $array_letter[1] . "-" . $new_num);
            }
        }

        return $last_pet;
    }

    public function getParents(Request $request)
    {
        try {
            $input = $request->all();

            if (isset($input['childrensSeleted'])) {
                $result = Pet::where('specie', $input['specie'])
                    ->where(function ($query) use ($input) {
                        $query->where('name', 'LIKE', '%' .  ucwords(strtolower($input['search'])) . '%')
                            ->orWhere('pet_id', 'LIKE', '%' . strtoupper($input['search']) . '%');
                    })
                    ->where('sex', $input['sex'])
                    ->where('pet_id', '<>', $input['pet_id'])
                    ->whereNotIn('pet_id', $input['childrensSeleted'])
                    ->select('name', 'pet_id')->get()->take(25);
            } else {
                $result = Pet::where('specie', $input['specie'])
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

            return redirect()->back()->with('info', trans('lang.pet_user_delete'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', trans('lang.user_error'));
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

            return redirect()->back()->with('info', trans('lang.pet_children_delete'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', trans('lang.user_error'));
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
                $pets = Pet::where('specie', $input['specie'])
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
                $pets = Pet::where('specie', $input['specie'])
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
