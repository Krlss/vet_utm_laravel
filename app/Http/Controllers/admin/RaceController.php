<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRaceRequest;
use App\Models\Race;
use App\Models\Specie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RaceController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:dashboard.races.index')->only('index');
        $this->middleware('can:dashboard.races.destroy')->only('destroy');
        $this->middleware('can:dashboard.races.create')->only('create', 'store', 'addRaceModal');
        $this->middleware('can:dashboard.races.edit')->only('edit', 'update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Race::with('specie')->get();
            return DataTables()->of($data)
                ->editColumn('specie', function ($race) {
                    return $race->specie ? $race->specie->name : __('Specie undefined');
                })
                ->editColumn('created_at', function ($race) {
                    $date = date_create($race->created_at);
                    return date_format($date, "d/m/Y");
                })
                ->editColumn('updated_at', function ($race) {
                    $date = date_create($race->updated_at);
                    return date_format($date, "d/m/Y");
                })
                ->addColumn('actions', function ($race) {
                    return view('dashboard.races.partials.actions', compact('race'));
                })
                ->make(true);
        }

        $races = [];
        return view('dashboard.races.index', compact('races'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $species = Specie::orderBy('name', 'asc')->pluck('name', 'id');

        return view('dashboard.races.create', compact('species'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRaceRequest $request)
    {
        $input = $request->all();

        DB::beginTransaction();
        try {
            $input['name'] = ucfirst(ucwords($input['name']));
            Race::create($input);
            DB::commit();
            return redirect()->route('dashboard.races.index')->with('success', __('Race created successfully'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', __('Error in create Race') . $e->getMessage())->withInput();
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
    public function edit(Race $race)
    {
        $species = Specie::orderBy('name', 'asc')->pluck('name', 'id');

        return view('dashboard.races.edit', compact('species', 'race'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateRaceRequest $request, Race $race)
    {
        $input = $request->all();

        DB::beginTransaction();
        try {
            $input['name'] = ucfirst(ucwords($input['name']));
            $race->update($input);

            DB::commit();
            return redirect()->route('dashboard.races.index')->with('success', __('Race updated successfully'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', __('Error in update Race') . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Race $race)
    {
        DB::beginTransaction();
        try {
            $race->delete();
            DB::commit();
            return redirect()->route('dashboard.races.index')->with('success', trans('Race deleted successfully'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', trans('Error in delete Race') . $e->getMessage());
        }
    }

    public function addRaceModal(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:races',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        } else {
            $race = Race::create([
                'name' => $request->name,
                'id_specie' => $request->id_specie
            ]);

            return response()->json($race);
        }
    }
}
