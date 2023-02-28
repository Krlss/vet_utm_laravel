<?php

namespace App\Http\Controllers;

use App\plan_terapeutico;
use App\hoja_clinica;
use App\linfonodo;
use App\especie;
use App\deshidratacion;
use App\mucosas;
use App\registro_mascota;
use App\sistemas;
use App\lista_problema;
use App\examen_fisico;
use App\lista_maestra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlanTerapeuticoController extends Controller
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
         $deshidratacion =deshidratacion::all();
         $plan_terapeutico = plan_terapeutico::all();
         $lista_maestra=sistemas::all();
         $hoja_clinica = hoja_clinica::all()->where('cod_mascota',$pet_id);
         $mascota=registro_mascota::all()->where('cod_mascota',$pet_id);
         return view('plan_terapeutico.create',compact('hoja_clinica','deshidratacion','mascota'));
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
                            'moreFields.*.medicamento'=>'required',
                            'moreFields.*.dosis_cant'=>'required',
                            'moreFields.*.dosis_tiempo'=>'required',
                            'moreFields.*.dosis_administra'=>'required',
                            'moreFields.*.frec_duracion'=>'required',
                            ]/*,
                            [
                             'moreFields.*.medicamento.required' => 'Debe ingresar el medicamente',
                             'moreFields.*.dosis_cant.required' => 'Debe asignar la cantidad para las horas',
                             'moreFields.*.dosis_tiempo.required' => 'Debe asignar las horas para la cantidad',
                             'moreFields.*.dosis_administra.required' => 'Debe ingresar los mg del medicamento',
                             'moreFields.*.frec_duracion.required' => 'Debe ingresar el periodo de duracion para la medicina']*/
                            );
        //dd($request);
                foreach($request->moreFields as $key => $value){
                plan_terapeutico::create($value);
            }
            return redirect('hoja_clinica/')->with('success','Ingreso correcto');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\plan_terapeutico  $plan_terapeutico
     * @return \Illuminate\Http\Response
     */
    public function show(plan_terapeutico $plan_terapeutico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\plan_terapeutico  $plan_terapeutico
     * @return \Illuminate\Http\Response
     */
    public function edit(plan_terapeutico $plan_terapeutico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\plan_terapeutico  $plan_terapeutico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, plan_terapeutico $plan_terapeutico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\plan_terapeutico  $plan_terapeutico
     * @return \Illuminate\Http\Response
     */
    public function destroy(plan_terapeutico $plan_terapeutico)
    {
        //
    }
}
