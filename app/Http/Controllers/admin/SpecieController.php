<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSpecieRequest;
use App\Models\Race;
use App\Models\Specie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpecieController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:dashboard.species.index')->only('index');
        $this->middleware('can:dashboard.species.destroy')->only('destroy');
        $this->middleware('can:dashboard.species.create')->only('create', 'store');
        $this->middleware('can:dashboard.species.edit')->only('edit', 'update');
    }

    public function index()
    {
        $species = Specie::orderBy('updated_at', 'DESC')->get();
        return view('dashboard.species.index', compact('species'));
    }

    public function create()
    {
        return view('dashboard.species.create');
    }

    public function store(CreateSpecieRequest $request)
    {

        $input = $request->all();

        DB::beginTransaction();
        try {
            $input['name'] = ucfirst(ucwords($input['name']));
            Specie::create($input);
            DB::commit();
            return redirect()->route('dashboard.species.index')->with('info', trans('lang.specie_created'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', trans('lang.specie_errpr') . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $specie = Specie::find($id);

        return view('dashboard.species.edit', compact('specie'));
    }

    public function update(CreateSpecieRequest $request, $id)
    {
        $input = $request->all();

        DB::beginTransaction();
        try {
            $input['name'] = ucfirst(ucwords($input['name']));
            $specie = Specie::find($id);
            $specie->update($input);
            DB::commit();
            return redirect()->route('dashboard.species.index')->with('info', trans('lang.specie_updated'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', trans('lang.specie_errpr') . $e->getMessage());
        }
    }

    public function destroy($id)
    {

        DB::beginTransaction();
        try {
            $specie = Specie::find($id);
            $specie->delete();
            DB::commit();
            return redirect()->route('dashboard.species.index')->with('info', trans('lang.specie_deleted'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', trans('lang.specie_errpr') . $e->getMessage());
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
}
