<?php

namespace App\Http\Controllers;

use App\Ingreso;
use Illuminate\Http\Request;
use App\Urbanizaciones;

class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['ingresos']=Ingreso::paginate(10);
    return view('ingresos.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $urbanizaciones=Urbanizaciones::all('nombre_urbanizacion');
        return view('ingresos.create',compact('urbanizaciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $datosIngresos=request()->except('_token');
        if($request->hasFile('Foto'!= null)){         

            $datosIngresos['Foto']=$request->file('Foto')->store('Img_Ingresos','public');
        }else{
            $datosIngresos['Foto']="Img_Egresos/enblanco.png";

}

      
        Ingreso::insert($datosIngresos);

        //return  response()->json($datosIngresos);
        return redirect('ingresos')->with('Mensaje','Imagen agregada con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ingreso  $ingreso
     * @return \Illuminate\Http\Response
     */
    public function show(Ingreso $ingreso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ingreso  $ingreso
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $ingresos= Ingreso::findOrFail($id);
         $urbanizaciones=Urbanizaciones::all('nombre_urbanizacion');
        return view('ingresos.edit',compact('ingresos','urbanizaciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ingreso  $ingreso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosIngresos=request()->except(['_token','_method']);
        Ingreso::where('id','=',$id)->update($datosIngresos);
         //$carrousell= Carrousell::findOrFail($id);

        //return view('carrousell.edit',compact('carrousell'));
        return redirect('ingresos')->with('Mensaje','Modificacion realizada con exito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ingreso  $ingreso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $eliminar= Ingreso::findOrFail($id);
        
        return redirect('ingresos')->with('Mensaje','Datos Eliminados con exito.');
    }
}
