<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $petsReport = Pet::where('lost', true)->count();
        $pets = Pet::all()->count();
        $users = User::all()->count();

        return view('dashboard.index', compact('petsReport', 'pets', 'users'));
    }
}
