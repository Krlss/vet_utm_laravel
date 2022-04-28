<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit as ModelsAudit;

class Audit extends Controller
{
    public function index()
    {

        $currentsAudit = ModelsAudit::orderBy('id', 'desc')->get();

        return view('dashboard.audit.index', compact('currentsAudit'));
    }

    public function show(ModelsAudit $audit)
    {

        $user_afect = null;
        $pet_afect = null;
        $user_guilty = null;

        //cambio algo de un usuario
        if ($audit->auditable_type == 'App\Models\User') {
            $user_afect = User::where('user_id', $audit->auditable_id)->first();
            //Modelo mascota
        } elseif ($audit->auditable_type == 'App\Models\Pet')
            $pet_afect = Pet::where('pet_id', $audit->auditable_id)->first();
        if ($audit->user_type) {
            $user_guilty = User::where('user_id', $audit->user_id)->first();
        }

        return view('dashboard.audit.show', compact('user_afect', 'pet_afect', 'user_guilty', 'audit'));
    }
}
