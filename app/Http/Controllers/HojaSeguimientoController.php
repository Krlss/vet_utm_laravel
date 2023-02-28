<?php

namespace App\Http\Controllers;

use App\hoja_seguimiento;
use App\especie;
use App\raza;
use App\vacuna;
use App\tipo_pelaje;
use App\linfonodo;
use App\lista_problema;
use App\genitales;

use Illuminate\Http\Request;

class HojaSeguimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['hoja_seguimiento']=hoja_seguimiento::paginate(10);
        return view('hoja_seguimiento.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('hoja_seguimiento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [];
 
        foreach($request->input('title') as $key => $value) {
            $data["title.{$key}"] = 'required';
        }
 
        $validator = Validator::make($request->all(), $data);
 
        if ($validator->passes()) {
 
            foreach($request->input('title') as $key => $value) {
                Todo::create(['title'=>$value]);
            }
 
            return response()->json(['success'=>'true']);
        }
 
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\hoja_seguimiento  $hoja_seguimiento
     * @return \Illuminate\Http\Response
     */
    public function show(hoja_seguimiento $hoja_seguimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\hoja_seguimiento  $hoja_seguimiento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hoja_seguimiento=hoja_seguimiento::findOrFail($id);
        return view('hoja_seguimiento.edit',compact('hoja_seguimiento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\hoja_seguimiento  $hoja_seguimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $hoja_seguimiento=request()->except(['_token','_method']);
         
         //dd($id);
         hoja_seguimiento::where('id','=',$id)->update($hoja_seguimiento);//todos los parametros
         return redirect('hoja_seguimiento')->with('Mensaje','Modificacion realizada con exito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\hoja_seguimiento  $hoja_seguimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eliminar= ing_equipo::findOrFail($id);
         ing_equipo::destroy($id);
        return redirect('ingreso_equipo')->with('Mensaje','Datos Eliminados con exito.');
    }
}
