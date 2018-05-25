<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\LocalNegocio;
use App\TipoNegocio;
use App\AdmiNegocio;
use App\User;
use Session;
use Illuminate\Http\Request;
use DB;

class infoempresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
         $this->middleware('auth');
     }

    public function index()
    {
    //  dd(auth()->user()->id);

        return view('infoempresa.operacion');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $reglas = [
        'name' => 'required|string|max:255',
        'ruc' => 'required|string|max:11',
        'telefono' => 'required|string|max:9',
        'latitud' => 'required|string|max:255',
        'longitud' => 'required|string|max:255',
        'telefono' => 'regex:/^[9|6|7][0-9]{8}$/',

      ];


        //$this->validate($request,$reglas);
        //dd($request);
        $cantidademp=DB::table('empresa')->count();
        if($cantidademp>1){
            Session::flash('message','Ya registró una empresa, verificar porfavor');
            return view('infoempresa.operacion');
        }
        else{
            $empresa=new Empresa();
            $tiponegocio=new TipoNegocio();
            $localnegocio =new LocalNegocio();
            $adminegocio=new AdmiNegocio();
            $usuario=new User();

            $empresa->nombreEmpresa=$request->input('name');
            $empresa->RUC =$request->input('ruc');
            $empresa->telefono =$request->input('telefono');
            $empresa->save();

            $localnegocio->latitud=$request->input('latitud');
            $localnegocio->longitud=$request->input('longitud');
            $localnegocio->descripcion=$request->input('descripcion');
            $localnegocio->telefono=$request->input('telefono');
            $localnegocio->Hora_inicio=$request->input('Hora_inicio');
            $localnegocio->Hora_fin=$request->input('Hora_fin');
            $localnegocio->Empresa_idEmpresa=$empresa->idEmpresa;
            $tiponegocio->nombre =$request->input('tipo');
            $tiponegocio->save();
            $localnegocio->TipoNegocio_idTipoNegocio =$tiponegocio->idTipoNegocio;
            $localnegocio->save();


            $adminegocio->idNegocio= $localnegocio->idNegocio;
            $adminegocio->Usuario_idUsuario=auth()->user()->id;
            $adminegocio->save();


            Session::flash('message','Empresa registrada correctamente');

            return view('infoempresa.operacion');

        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
