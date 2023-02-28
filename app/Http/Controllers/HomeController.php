<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\carrousell;
use App\Carrouselldos;
use Auth;
use App\Pagos_alicuotas;
use App\Noticias_urbanizacion;
use App\Horarios_reuniones;
use App\Horarios_limpieza;
use App\Horarios_basura;
use App\Ingreso;
use App\Egreso;
use App\Incidencias;
use App\Subirpdf;
use App\Tokenes;
use App\Terminos;
use App\Notificaciones;
use App\Actualizacion_pago;
use App\Gadmunicipales;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::id();
        return view('home');
    }
}
