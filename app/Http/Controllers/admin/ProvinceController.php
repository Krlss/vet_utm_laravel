<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProvinceRequest;
use App\Models\Canton;
use App\Models\Parish;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProvinceController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:dashboard.provinces.index')->only('index');
        $this->middleware('can:dashboard.provinces.create')->only(['create', 'store']);
        $this->middleware('can:dashboard.provinces.edit')->only(['edit', 'update']);
        $this->middleware('can:dashboard.provinces.destroy')->only('destroy');
    }


    public function index()
    {
        $provinces = Province::all();
        return view('dashboard.provinces.index', compact('provinces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lettersAvailable = getLettersAvailable();
        $province = null;
        return view('dashboard.provinces.create', compact('lettersAvailable', 'province'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProvinceRequest $request)
    {
        try {
            DB::beginTransaction();
            $request->letter = strtoupper($request->letter);
            Province::create($request->all());
            DB::commit();
            return redirect()->route('dashboard.provinces.index')->with('success', __('Province created successfully'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route('dashboard.provinces.index')->with('error', __('Error creating province') . $e->getMessage())->withInput();
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
    public function edit(Province $province)
    {
        $lettersAvailable = getLettersAvailable($province->letter);
        return view('dashboard.provinces.edit', compact('province', 'lettersAvailable'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProvinceRequest $request, Province $province)
    {
        try {
            DB::beginTransaction();
            $province->update($request->all());
            DB::commit();
            return redirect()->route('dashboard.provinces.index')->with('success', __('Province created successfully'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', __('Error in update Province') . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $province = Province::findOrFail($id);
            $province->delete();
            DB::commit();
            return redirect()->route('dashboard.provinces.index')->with('success', __('Province deleted successfully'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route('dashboard.provinces.index')->with('error', __('Error deleting province') . $e->getMessage());
        }
    }

    public function AllCantonsByProvince(Request $request)
    {
        try {
            $input = $request->all();

            $result = Canton::where('id_province', $input['id_province'])->select('name', 'id')->get();

            return response()->json($result);
        } catch (\Throwable $e) {
            return response()->json([]);
        }
    }

    public function AllParishesByCanton(Request $request)
    {
        try {
            $input = $request->all();

            $result = Parish::where('id_canton', $input['id_canton'])->select('name', 'id')->get();

            return response()->json($result);
        } catch (\Throwable $e) {
            return response()->json([]);
        }
    }
}
