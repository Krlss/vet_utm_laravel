<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Race;
use App\Models\Specie;
use Illuminate\Http\Request;

class SpeciesApiController extends Controller
{
    public function getAllSpecies()
    {
        $species = Specie::all();
        return response()->json(['message' => 'All specie', 'data' => $species], 200);
    }

    public function getRacesBySpecie($id)
    {

        $races = Race::where('id_specie', $id)->get();
        return response()->json(['message' => 'All races', 'data' => $races], 200);
    }
}
