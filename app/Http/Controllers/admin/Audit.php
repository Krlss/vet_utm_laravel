<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use OwenIt\Auditing\Models\Audit as ModelsAudit;

class Audit extends Controller
{
    public function __construct()
    {
        $this->middleware('can:dashboard.audit.index')->only('index');
        $this->middleware('can:dashboard.audit.show')->only('show');
    }

    public function index()
    {

        $currentsAudit = ModelsAudit::orderBy('id', 'desc')->get();

        return view('dashboard.audit.index', compact('currentsAudit'));
    }

    public function show()
    {
    }
}
