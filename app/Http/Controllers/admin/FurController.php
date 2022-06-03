<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateFurRequest;
use App\Models\Fur;
use App\Models\Specie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FurController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:dashboard.furs.index')->only('index');
        $this->middleware('can:dashboard.furs.destroy')->only('destroy');
        $this->middleware('can:dashboard.furs.create')->only('create', 'store');
        $this->middleware('can:dashboard.furs.edit')->only('edit', 'update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $furs = Fur::orderBy('updated_at', 'DESC')->get();
        return view('dashboard.furs.index', compact('furs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $species = Specie::orderBy('name')->pluck('name', 'id');
        $speciesSelected = [];
        return view('dashboard.furs.create', compact('species', 'speciesSelected'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFurRequest $request)
    {
        $input = $request->all();

        DB::beginTransaction();
        try {
            $input['name'] = ucfirst(ucwords($input['name']));
            $fur = Fur::create($input);

            if ($request->has('species')) {
                $fur->species()->sync($request->species);
            }

            DB::commit();
            return redirect()->route('dashboard.furs.index')->with('success', __('Pelaje creado con éxito'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', __('Error al crear pelaje') . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Fur $fur)
    {
        $species = Specie::orderBy('name')->pluck('name', 'id');
        $speciesSelected = $fur->species()->pluck('species.id')->toArray();

        return view('dashboard.furs.edit', compact('fur', 'species', 'speciesSelected'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateFurRequest $request, Fur $fur)
    {
        $input = $request->all();

        DB::beginTransaction();
        try {
            $input['name'] = ucfirst(ucwords($input['name']));
            $fur->update($input);

            $fur->species()->sync($request->species);

            DB::commit();
            return redirect()->route('dashboard.furs.index')->with('success', __('Fur updated successfully'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', __('Error in update fur') . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fur $fur)
    {
        DB::beginTransaction();
        try {
            $fur->delete();
            DB::commit();
            return redirect()->route('dashboard.furs.index')->with('success', __('Fur deleted successfully'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', __('Error in delete fur') . $e->getMessage());
        }
    }

    public function getFursToAjax(Request $request)
    {
        try {
            $input = $request->all();

            $result = Fur::where('name', 'LIKE', '%' .  ucwords(strtolower($input['search'])) . '%')
                ->select('name', 'id')
                ->get()
                ->take(25);

            return response()->json($result);
        } catch (\Throwable $th) {
            return json_encode(['furs' => []]);
        }
    }

    public function addFurModal(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:furs',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        } else {
            try {
                DB::beginTransaction();
                $fur = Fur::create([
                    'name' => $request->name,
                ]);
                $fur->species()->sync($request->id_specie);

                DB::commit();
                return response()->json($fur);
            } catch (\Throwable $th) {
                return response()->json(['error' => $th]);
            }
        }
    }
}
