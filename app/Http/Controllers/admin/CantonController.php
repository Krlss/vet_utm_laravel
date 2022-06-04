<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CantonRequest;
use App\Models\Canton;
use App\Models\Province;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CantonController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:dashboard.cantons.index')->only('index');
        $this->middleware('can:dashboard.cantons.create')->only(['create', 'store', 'addCantonModal']);
        $this->middleware('can:dashboard.cantons.edit')->only(['edit', 'update']);
        $this->middleware('can:dashboard.cantons.destroy')->only('destroy');
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Canton::with('province')->get();
            return DataTables()->of($data)
                ->editColumn('province', function ($canton) {
                    return $canton->province->name ?? __('Province undefined');
                })
                ->editColumn('updated_at', function ($canton) {
                    $date = date_create($canton->updated_at);
                    return date_format($date, "d/m/Y");
                })
                ->editColumn('created_at', function ($canton) {
                    $date = date_create($canton->updated_at);
                    return date_format($date, "d/m/Y");
                })
                ->addColumn('actions', function ($canton) {
                    return view('dashboard.cantons.partials.actions', compact('canton'));
                })
                ->make(true);
        }
        $cantons = [];
        return view('dashboard.cantons.index', compact('cantons'));
    }


    public function create()
    {
        $provinces = Province::pluck('name', 'id')->toArray();

        $lettersAvailable = getLettersAvailable();

        return view('dashboard.Cantons.create', compact('provinces', 'lettersAvailable'));
    }


    public function store(CantonRequest $request)
    {
        try {
            DB::beginTransaction();
            Canton::create($request->all());
            DB::commit();
            return redirect()->route('dashboard.cantons.index')->with('success', __('Canton created successfully'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route('dashboard.cantons.index')->with('error', __('Error creating canton') . $e->getMessage())->withInput();
        }
    }


    public function show($id)
    {
        //
    }


    public function edit(Canton $canton)
    {
        $provinces = Province::pluck('name', 'id');

        $lettersAvailable = getLettersAvailable();

        return view('dashboard.cantons.edit', compact('canton', 'provinces', 'lettersAvailable'));
    }


    public function update(CantonRequest $request, Canton $canton)
    {
        try {
            DB::beginTransaction();
            $canton->update($request->all());
            DB::commit();
            return redirect()->route('dashboard.cantons.index')->with('success', __('Canton created successfully'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', __('Error in update canton') . $e->getMessage())->withInput();
        }
    }


    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $canton = Canton::findOrFail($id);
            $canton->delete();
            DB::commit();
            return redirect()->route('dashboard.cantons.index')->with('success', __('Canton deleted successfully'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route('dashboard.cantons.index')->with('error', __('Error deleting canton') . $e->getMessage());
        }
    }

    public function addCantonModal(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:cantons',
            'id_province' => 'required|integer|exists:provinces,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        } else {
            $canton = Canton::create([
                'name' => $request->name,
                'id_province' => $request->id_province
            ]);

            return response()->json($canton);
        }
    }
}
