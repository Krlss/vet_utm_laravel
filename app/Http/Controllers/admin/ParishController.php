<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParishRequest;
use App\Models\Canton;
use App\Models\Parish;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ParishController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:dashboard.parishs.index')->only('index');
        $this->middleware('can:dashboard.parishs.create')->only(['create', 'store']);
        $this->middleware('can:dashboard.parishs.edit')->only(['edit', 'update']);
        $this->middleware('can:dashboard.parishs.destroy')->only('destroy');
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Parish::with(['canton' => function ($query) {
                $query->with('province');
            }])->get();
            return DataTables()->of($data)
                ->editColumn('province', function ($data) {
                    return $data->canton->province->name;
                })
                ->editColumn('canton', function ($data) {
                    return $data->canton->name;
                })
                ->editColumn('updated_at', function ($data) {
                    $date = date_create($data->updated_at);
                    return date_format($date, "d/m/Y");
                })
                ->editColumn('created_at', function ($data) {
                    $date = date_create($data->updated_at);
                    return date_format($date, "d/m/Y");
                })
                ->addColumn('actions', function ($parish) {
                    return view('dashboard.parishs.partials.actions', compact('parish'));
                })
                ->make(true);
        }
        return view('dashboard.parishs.index');
    }

    public function create()
    {
        $cantons = Canton::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        $provinces = [];

        //validate user have permission to create parish
        if (Auth::user()->hasPermissionTo('dashboard.provinces.create')) {
            $provinces = Province::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        }

        return view('dashboard.parishs.create', compact('cantons', 'provinces'));
    }

    public function store(ParishRequest $request)
    {
        try {
            DB::beginTransaction();
            Parish::create($request->all());
            DB::commit();
            return redirect()->route('dashboard.parishs.index')->with('success', __('Parish created successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', __('Error in create parish') . $e->getMessage())->withInput();
        }
    }

    public function edit(Parish $parish)
    {
        $cantons = Canton::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        $provinces = [];

        //validate user have permission to edit parish
        if (Auth::user()->hasPermissionTo('dashboard.provinces.edit')) {
            $provinces = Province::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        }

        return view('dashboard.parishs.edit', compact('parish', 'cantons', 'provinces'));
    }

    public function update(ParishRequest $request, Parish $parish)
    {
        try {
            DB::beginTransaction();
            $parish->update($request->all());
            DB::commit();
            return redirect()->route('dashboard.parishs.index')->with('success', __('Parish updated successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', __('Error in update parish') . $e->getMessage())->withInput();
        }
    }

    public function destroy(Parish $parish)
    {
        try {
            DB::beginTransaction();
            $parish->delete();
            DB::commit();
            return redirect()->route('dashboard.parishs.index')->with('success', __('Parish deleted successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', __('Error in delete parish') . $e->getMessage());
        }
    }
}
