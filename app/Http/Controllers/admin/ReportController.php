<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePetRequest;
use App\Http\Requests\UpdatePetRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewReport;
use App\Models\Fur;
use App\Models\Parish;
use App\Models\Race;
use App\Models\Specie;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:dashboard.reports.index')->only('index');
        $this->middleware('can:dashboard.reports.destroy')->only('destroy');
        /* $this->middleware('can:dashboard.reports.create')->only('create', 'store'); */
        $this->middleware('can:dashboard.reports.edit')->only('edit', 'update');
        $this->middleware('can:dashboard.destroyImageGoogle')->only('destroyImageGoogle');
    }

    public function index()
    {
        $pets = Pet::where('lost', true)->orderBy('updated_at', 'DESC')->get();
        return view('dashboard.reports.index', compact('pets'));
    }

    public function create()
    {
    }

    public function store(CreatePetRequest $request)
    {
    }

    public function show($id)
    {
        $pet = Pet::where('pet_id', $id)->first();

        return view('dashboard.reports.show', compact('pet'));
    }

    public function edit($id)
    {
        $pet = Pet::where('pet_id', $id)->first();
        $users = User::pluck('user_id', 'user_id');
        $images_ = $pet->images()->select('id_image', 'name', 'url')->get()->toArray();

        $species = Specie::orderBy('name', 'asc')->pluck('name', 'id');
        $races = Race::where('id_specie', $pet->id_specie)->orderBy('name', 'asc')->pluck('name', 'id');
        $furs = Fur::orderBy('name', 'asc')->pluck('name', 'id');

        return view('dashboard.reports.edit', compact('pet', 'users', 'images_', 'species', 'races', 'furs'));
    }

    public function update(UpdatePetRequest $request, Pet $pet)
    {
        $input = $request->all();
        /* $input['user_id'] = $input['users'] ? $input['users'] : null; */

        $petUpdated = Pet::where('pet_id', $input['pet_id'])->first();

        DB::beginTransaction();
        try {
            if ($request->hasFile('images')) {
                $request->validate([
                    'images*' => 'image|mimes:jpg,png,jpeg,webp,svg'
                ]);
                uploadImagesDashboard($request->file('images'), $petUpdated->pet_id);
            } else {
                //Ahora eliminamos las imagenes si llega a tener, porque desde la vista no nos envían imagenes...
                $imagesCurrent = Image::where('pet_id', $input['pet_id'])->get();
                foreach ($imagesCurrent as $imgC) {
                    Storage::disk("google")->delete($imgC->id_image);
                    $imgC->delete();
                }
            }

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

    public function destroy(Pet $pet)
    {
    }
    public function destroyImageGoogle(Request $request)
    {
        $input = $request->all();

        try {
            DB::beginTransaction();
            $imagePet = Image::where('url', $input['url'])->first();
            Storage::disk("google")->delete($imagePet->id_image);
            $imagePet->delete();
            DB::commit();
            return redirect()->back()->with('info', trans('lang.image_pet_reporte_deleted'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', trans('lang.user_error'));
        }
    }
}
