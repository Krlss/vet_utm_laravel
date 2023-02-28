<?php

namespace App\Http\Controllers;

use App\Carrouselldos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class CarrouselldosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      

        $datos['carrouselldos']=Carrouselldos::paginate(100);
    return view('carrouselldos.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('carrouselldos.create');
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

        Carrouselldos::insert($datosCarrousell);

        //return  response()->json($datosCarrousell);
        return redirect('carrouselldos')->with('Mensaje','Imagen agregada con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Carrouselldos  $carrouselldos
     * @return \Illuminate\Http\Response
     */
    public function show(Carrouselldos $carrouselldos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Carrouselldos  $carrouselldos
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
    {
        //
        $carrouselldos= Carrouselldos::findOrFail($id);

        return view('carrouselldos.edit',compact('carrouselldos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Carrouselldos  $carrouselldos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

         $datosCarrousell=request()->except(['_token','_method']);
          if($request->hasFile('Foto')){
            $carrousell= Carrouselldos::findOrFail($id);
            Storage::delete('public/'.$carrousell->Foto);
           

            $datosCarrousell['Foto']=$request->file('Foto')->store('Img_carrousel','public');
        }

         //dd($id);
         Carrouselldos::where('id','=',$id)->update($datosCarrousell);
         //$carrousell= Carrousell::findOrFail($id);

        //return view('carrousell.edit',compact('carrousell'));
        return redirect('carrouselldos')->with('Mensaje','Imagen Moidificada con exito.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Carrouselldos  $carrouselldos
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
    {
        //
        $carrousell= Carrouselldos::findOrFail($id);
        if(Storage::delete('public/'.$carrousell->Foto)){
        Carrouselldos::destroy($id);}

        return redirect('carrouselldos')->with('Mensaje','Imagen Eliminada con exito.');
        
    }
}
