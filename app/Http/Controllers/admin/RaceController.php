<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRaceRequest;
use App\Models\Race;
use App\Models\Specie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RaceController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:dashboard.races.index')->only('index');
        $this->middleware('can:dashboard.races.destroy')->only('destroy');
        $this->middleware('can:dashboard.races.create')->only('create', 'store');
        $this->middleware('can:dashboard.races.edit')->only('edit', 'update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $races = Race::orderBy('updated_at', 'DESC')->get();
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
            return redirect()->route('dashboard.races.index')->with('info', trans('lang.race_created'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', trans('lang.race_errpr') . $e->getMessage());
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
            return redirect()->route('dashboard.races.index')->with('info', trans('lang.race_updated'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', trans('lang.race_errpr') . $e->getMessage());
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
            return redirect()->route('dashboard.races.index')->with('info', trans('lang.race_deleted'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', trans('lang.race_errpr') . $e->getMessage());
        }
    }
}