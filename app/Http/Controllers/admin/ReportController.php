<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdatePetRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Fur;
use App\Models\Race;
use App\Models\Report;
use App\Models\Specie;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:dashboard.reports.index')->only('index');
        $this->middleware('can:dashboard.reports.destroy')->only('destroy');
        $this->middleware('can:dashboard.reports.edit')->only('edit', 'update');
        $this->middleware('can:dashboard.destroyImageGoogle')->only('destroyImageGoogle');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pet::where('lost', true)->get();
            return DataTables()->of($data)
                ->editColumn('user', function ($pet) {
                    return $pet->user ? $pet->user->user_id : __('Owner undefined');
                })
                ->editColumn('specie', function ($pet) {
                    return $pet->specie ? $pet->specie->name : __('Specie undefined');
                })
                ->editColumn('published', function ($pet) {
                    return $pet->published ? __('Yes') : __('No');
                })
                ->editColumn('updated_at', function ($pet) {
                    $date = date_create($pet->updated_at);
                    return date_format($date, "d/m/Y");
                })
                ->addColumn('actions', function ($pet) {
                    return view('dashboard.reports.partials.actions', compact('pet'));
                })
                ->make(true);
        }

        $pets = [];
        return view('dashboard.reports.index', compact('pets'));
    }

    public function show($id)
    {
        $pet = Pet::where('pet_id', $id)->first();

        $report = Report::where('pet_id', $id)->first();

        return view('dashboard.reports.show', compact('pet', 'report'));
    }

    public function edit($id)
    {
        $pet = Pet::where('pet_id', $id)->first();
        $users = User::pluck('user_id', 'user_id');
        $images_ = $pet->images()->select('id_image', 'name', 'url')->get()->toArray();

        $species = Specie::orderBy('name', 'asc')->pluck('name', 'id');
        $races = Race::where('id_specie', $pet->id_specie)->orderBy('name', 'asc')->pluck('name', 'id');
        $furs = Fur::whereRelation('species', 'species.id', $pet->id_specie)->orderBy('name', 'asc')->pluck('name', 'id');

        return view('dashboard.reports.edit', compact('pet', 'users', 'images_', 'species', 'races', 'furs'));
    }

    public function update(UpdatePetRequest $request, Pet $pet)
    {
        $input = $request->all();
        /* $input['user_id'] = $input['users'] ? $input['users'] : null; */

        $petUpdated = Pet::where('pet_id', $input['pet_id'])->first();

        DB::beginTransaction();
        try {

            $request->validate([
                'images*' => 'image|mimes:jpg,png,jpeg,webp,svg'
            ]);
            uploadImage($request->file('images'), $petUpdated->pet_id);

            if ($petUpdated->published == 0 && $input['published'] == 1) {
                sendNotificationEmailToPetLost($input);
            }

            $petUpdated->update($input);
            DB::commit();
            return redirect()->route('dashboard.reports.show', $petUpdated)->with('success', __('Pet updated successfully'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', __('Error updating pet') . ' ' . $e->getMessage())->withInput();
        }
    }
}
