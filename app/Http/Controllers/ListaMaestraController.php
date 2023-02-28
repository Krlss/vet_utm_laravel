<?php

namespace App\Http\Controllers;

use App\lista_maestra;
use App\lista_problema;
use App\linfonodo;
use App\especie;
use App\deshidratacion;
use App\mucosas;
use App\registro_mascota;
use App\hoja_clinica;
use App\sistemas;
use App\plan_terapeutico;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ListaMaestraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($pet_id)
    {
        $lista_maestra=sistemas::all();
        $hoja_clinica=hoja_clinica::all()->where('cod_mascota',$pet_id);
        $lista_problema=lista_problema::select('lista_problemas.*')->orderBy('id_maestra')->get();
         $mascota=registro_mascota::all()->where('cod_mascota',$pet_id);
         return view('lista_maestra.create',compact('mascota','lista_maestra','lista_problema','hoja_clinica'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
                            'moreFields.*.fecha_consulta'=>'required',
                            'moreFields.*.cod_mascota'=>'required',
                            'moreFields.*.sistema'=>'required',
                            'moreFields.*.problema'=>'required',
                            //'moreFields.*.diagnostico_diferencial'=>'required',
                            ],
                            [
                             'moreFields.*.sistema.required' => 'Seleccione el sistema',
                             'moreFields.*.problema.required' => 'Debe seleccionar un problema acompañado de cada sistema por favor',
                            ]);
        //dd($request);
        foreach($request->moreFields as $key => $value){
                lista_maestra::create($value);
            }
            //return back()->with('success','Ingreso correcto');
            return redirect('plan_terapeutico/create/'.$request->cod_mascota)->with('success','Ingreso correcto');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\lista_maestra  $lista_maestra
     * @return \Illuminate\Http\Response
     */
    public function show(lista_maestra $lista_maestra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\lista_maestra  $lista_maestra
     * @return \Illuminate\Http\Response
     */
    public function edit(lista_maestra $lista_maestra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\lista_maestra  $lista_maestra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, lista_maestra $lista_maestra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\lista_maestra  $lista_maestra
     * @return \Illuminate\Http\Response
     */
    public function destroy(lista_maestra $lista_maestra)
    {
        $eliminar= lista_maestra::findOrFail($id);
         lista_maestra::destroy($id);
        return redirect('lista_maestra')->with('Mensaje','Datos Eliminados con exito.');
    }
}
