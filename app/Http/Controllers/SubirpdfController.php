<?php

namespace App\Http\Controllers;

use App\Subirpdf;
use Illuminate\Http\Request;
use App\Urbanizaciones;
use Illuminate\Support\Facades\Storage;
use App\Ingreso;
use App\Egreso;


class SubirpdfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $datos['subirpdf']=Subirpdf::paginate(10);
    return view('subirpdf.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $urbanizaciones=Urbanizaciones::all('nombre_urbanizacion');
        return view('subirpdf.create',compact('urbanizaciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $datossubirpdf=request()->except('_token');

        if($request->hasFile('pdf')){         

            $datossubirpdf['pdf']=$request->file('pdf')->store('PDF_Subidos','public');
        }

        Subirpdf::insert($datossubirpdf);

        return  response()->json($datossubirpdf);
        //return redirect('subirpdf')->with('Mensaje','Archivo agregado con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subirpdf  $subirpdf
     * @return \Illuminate\Http\Response
     */
    public function show(Subirpdf $subirpdf)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subirpdf  $subirpdf
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $subirpdf= Subirpdf::findOrFail($id);
         $urbanizaciones=Urbanizaciones::all('nombre_urbanizacion');
        return view('subirpdf.edit',compact('subirpdf','urbanizaciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subirpdf  $subirpdf
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $datossubirpdf=request()->except(['_token','_method']);
          if($request->hasFile('pdf')){
            $subirpdf= Subirpdf::findOrFail($id);
            Storage::delete('public/'.$subirpdf->pdf);
           

            $datossubirpdf['pdf']=$request->file('pdf')->store('subirpdf','public');
        }

         //dd($id);
         Subirpdf::where('id','=',$id)->update($datossubirpdf);
         //$carrousell= Carrousell::findOrFail($id);

        //return view('carrousell.edit',compact('carrousell'));
        return redirect('subirpdf')->with('Mensaje','Dato Moidificado con exito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subirpdf  $subirpdf
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $subirpdf= Subirpdf::findOrFail($id);
        if(Storage::delete('public/'.$subirpdf->pdf)){
        Subirpdf::destroy($id);}

        return redirect('subirpdf')->with('Mensaje','Dato Eliminado con exito.');
    }

   
}
