<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class Audit extends Controller
{
    public function index()
    {
        $audits = User::first();

        return view('dashboard.audit.index', compact('audits'));
    }
}
