<?php

namespace App\Http\Controllers;

use App\lista_problema;
use App\lista_maestra;
use App\linfonodo;
use App\especie;
use App\deshidratacion;
use App\mucosas;
use App\registro_mascota;
use App\sistemas;
use App\plan_terapeutico;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ListaProblemaController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['lista_problemas']=lista_problema::paginate(1000);
        
        return view('lista_problemas.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $sistemas=sistemas::all();
         return view('lista_problemas.create',compact('sistemas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $lista_problemas = $request->validate([
        'nom_problema'=>'required|unique:lista_problemas|max:255|nullable',      
        ], [
            'nom_problema.required' => 'El campo nombre problema es obligatorio',
            'nom_problema.unique' => 'Ya existe un problema con ese nombre'
            ]);
        lista_problema::insert($lista_problemas);
        return redirect('lista_problemas')->with('Mensaje','Datos ingresados con exito.');

        /*$request->validate(['moreFields.*.fecha_consulta'=>'required',
                            'moreFields.*.cod_mascota'=>'required',
                            'moreFields.*.sistema'=>'required',
                            'moreFields.*.problema'=>'required']);
        
        foreach($request->moreFields as $key => $value){
                lista_maestra::create($value);
            }
            return back()->with('success','Ingreso correcto');*/

        /*$data= [];
        foreach($request->input('diagnostico_diferencial') as $key => $value){
            $data["diagnostico_diferencial.{$key}"] = 'required';
        }

        $validator = Validator::make($request->all(),$data);

        if ($validator->passes()) {
            foreach($request->input('diagnostico_diferencial') as $key => $value){
                lista_maestra::create(['diagnostico_diferencial'=>$value],
                                      ['cod_mascota'=>$value],
                                      ['fecha_consulta'=>$value]);

            }
            return response()->json(['success'=>'true']);
        }
        return response()->json(['error'=>$validator->errors()->all()]);*/
    }

    public function show(lista_problema $lista_problema)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\lista_problema  $lista_problema
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lista_problemas=lista_problema::findOrFail($id);
        return view('lista_problemas.edit', compact('lista_problemas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\lista_problema  $lista_problema
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lista_problemas=request()->except(['_token','_method']);
         
         //dd($id);
         lista_problema::where('id','=',$id)->update($lista_problemas);
         //$carrousell= Carrousell::findOrFail($id);

        //return view('carrousell.edit',compact('carrousell'));
        return redirect('lista_problemas')->with('Mensaje','Modificacion realizada con exito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\lista_problema  $lista_problema
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eliminar= lista_problema::findOrFail($id);
         lista_problema::destroy($id);
        return redirect('lista_problemas')->with('Mensaje','Datos Eliminados con exito.');
    }

   public function bysistema($id)
    {
        // $problema= lista_problema::where('id_maestra',$id)->get();
        return lista_problema::where('id_maestra',$id)->get();
    }
}
