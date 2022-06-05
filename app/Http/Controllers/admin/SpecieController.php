<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSpecieRequest;
use App\Models\Race;
use App\Models\Specie;
use App\Models\Fur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SpecieController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:dashboard.species.index')->only('index');
        $this->middleware('can:dashboard.species.destroy')->only('destroy');
        $this->middleware('can:dashboard.species.create')->only('create', 'store', 'addSpecieModal');
        $this->middleware('can:dashboard.species.edit')->only('edit', 'update');
    }

    public function index()
    {
        $species = Specie::orderBy('updated_at', 'DESC')->get();
        return view('dashboard.species.index', compact('species'));
    }

    public function create()
    {
        $furs = Fur::orderBy('name')->pluck('name', 'id');
        $fursSelected = [];
        return view('dashboard.species.create', compact('furs', 'fursSelected'));
    }

    public function store(CreateSpecieRequest $request)
    {

        $input = $request->all();

        DB::beginTransaction();
        try {
            $input['name'] = ucfirst(ucwords($input['name']));
            $specie = Specie::create($input);

            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => 'image|mimes:jpg,png,jpeg,webp,svg'
                ]);
                uploadImageDashboard($request->file('image'), $specie->id);
            }

            if ($request->has('id_fur')) {
                $specie->furs()->sync($request->id_fur);
            }

            DB::commit();
            return redirect()->route('dashboard.species.index')->with('success', __('Specie created successfully'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', __('Error in create specie') . ' ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $specie = Specie::find($id);

        $furs = Fur::orderBy('name')->pluck('name', 'id')->toArray();
        $fursSelected = $specie->furs()->pluck('furs.id')->toArray();

        return view('dashboard.species.edit', compact('specie', 'furs', 'fursSelected'));
    }

    public function update(CreateSpecieRequest $request, $id)
    {
        $input = $request->all();

        DB::beginTransaction();
        try {
            $input['name'] = ucfirst(ucwords($input['name']));
            $specie = Specie::find($id);
            $specie->update($input);

            if ($request->hasFile('image')) {
                uploadImageDashboard($request->file('image'), $specie->id);
            }

            $specie->furs()->sync($request->id_fur);

            DB::commit();
            return redirect()->route('dashboard.species.index')->with('success', __('Specie updated successfully'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', __('Error in update specie') . ' ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {

        DB::beginTransaction();
        try {
            $specie = Specie::find($id);

            if ($specie->image) {
                Storage::disk("google")->delete($specie->image->id_image);
                $specie->image->delete();
            }

            $specie->delete();
            DB::commit();
            return redirect()->route('dashboard.species.index')->with('success', __('Specie deleted successfully'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', __('Error in delete specie') . ' ' . $e->getMessage());
        }
    }

    public function getRacesToSpeciesAjax(Request $request)
    {
        try {
            $input = $request->all();

            $result = Race::where('id_specie', $input['id_specie'])
                ->select('name', 'id')
                ->orderBy('name', 'asc')
                ->get();

            return response()->json($result);
        } catch (\Throwable $th) {
            return json_encode(['species' => []]);
        }
    }

    public function getFursToSpeciesAjax(Request $request)
    {
        try {
            $input = $request->all();

            $result = Fur::whereRelation('species', 'species.id', $input['id_specie'])
                ->select('name', 'id')
                ->orderBy('name', 'asc')
                ->get();

            return response()->json($result);
        } catch (\Throwable $th) {
            return json_encode(['furs' => []]);
        }
    }

    public function addSpecieModal(Request $request)
    {

        $input = $request->all();

        $input['name'] = $input['name_specie'];
        unset($input['name_specie']);

        $validator = Validator::make($input, [
            'name' => 'required|string|max:255|unique:species',
            'image' => 'image|mimes:jpg,png,jpeg,webp,svg'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        } else {

            $specie = Specie::create([
                'name' => $input['name'],
            ]);

            if ($request->hasFile('image')) {
                uploadImageDashboard($request->file('image'), $specie->id);
            }

            return response()->json($specie);
        }
    }
}
