<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Canton;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceApiController extends Controller
{
    public function getAllProvinces(){
        $provinces = Province::all();
        return response()->json(['message'=>'All provinces', 'data' => $provinces], 200);
    }

    public function getCantonsByProvince($id){

        $cantons = Canton::where('id_province', $id)->get();
        return response()->json(['message'=>'All cantons', 'data' => $cantons], 200);
    }
}
