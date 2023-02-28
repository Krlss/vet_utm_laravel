<?php

namespace App\Http\Controllers;

use App\carrousell;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Storage;
class CarrousellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        


        $datos['carrousell']=Carrousell::paginate(10);
    return view('carrousell.index',$datos);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

       
    return view('carrousell.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $datosCarrousell=request()->except('_token');

        if($request->hasFile('Foto')){         

            $datosCarrousell['Foto']=$request->file('Foto')->store('Img_carrousel','public');
        }

        Carrousell::insert($datosCarrousell);

        //return  response()->json($datosCarrousell);
        return redirect('carrousell')->with('Mensaje','Imagen agregada con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\carrousell  $carrousell
     * @return \Illuminate\Http\Response
     */
    public function show(carrousell $carrousell)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\carrousell  $carrousell
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $carrousell= Carrousell::findOrFail($id);

        return view('carrousell.edit',compact('carrousell'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\carrousell  $carrousell
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

         $datosCarrousell=request()->except(['_token','_method']);
          if($request->hasFile('Foto')){
            $carrousell= Carrousell::findOrFail($id);
            Storage::delete('public/'.$carrousell->Foto);
           

            $datosCarrousell['Foto']=$request->file('Foto')->store('Img_carrousel','public');
        }

         //dd($id);
         Carrousell::where('id','=',$id)->update($datosCarrousell);
         //$carrousell= Carrousell::findOrFail($id);

        //return view('carrousell.edit',compact('carrousell'));
        return redirect('carrousell')->with('Mensaje','Imagen Moidificada con exito.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\carrousell  $carrousell
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $carrousell= Carrousell::findOrFail($id);
        if(Storage::delete('public/'.$carrousell->Foto)){
        Carrousell::destroy($id);}

        return redirect('carrousell')->with('Mensaje','Imagen Eliminada con exito.');
        
    }
}
