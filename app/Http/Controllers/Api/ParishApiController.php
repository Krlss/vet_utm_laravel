<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Parish;
use Illuminate\Http\Request;

class ParishApiController extends Controller
{
    public function getParishesByCanton($id){

        $parishs = Parish::where('id_canton', $id)->get();
        return response()->json(['message'=>'All parishs', 'data' => $parishs], 200);
    }
}
