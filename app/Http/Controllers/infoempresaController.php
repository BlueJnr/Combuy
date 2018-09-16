<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\LocalNegocio;
use App\TipoNegocio;
use App\AdmiNegocio;
use App\User;
use App\TipoLocal;
use Session;
use Illuminate\Http\Request;
use DB;
use Input;

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
        try{
            $reglas = [
                'latitud' => 'max:30',
                'longitud' => 'max:30',
                'telefono' => ['required','min:9','max:9','regex:/^[9][0-9]{8}$/'],
                'descripcion' => 'required|max:50',
                'Hora_inicio' => ['required','min:4','max:5','regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'],
                'Hora_fin' => ['required','min:4','max:5','regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'],
                'ruc' => 'required|min:10|max:10',
                
              ];
              $messages = [
                'telefono.regex' => ' El teléfono ingresado no cumple con el formato adecuado.',
                'telefono.min' => ' El teléfono ingresado debe tener :min caracteres numéricos.',
                'telefono.max' => 'El teléfono ingresado debe tener :max caracteres numéricos.',
                'Hora_inicio.max' =>' Formato de hora incorrecto HH:MM.',
                'Hora_inicio.min' =>' Formato de hora incorrecto HH:MM.',
                'Hora_inicio.regex' =>' Formato de hora incorrecto HH:MM.',
                'Hora_fin.max' =>' Formato de hora incorrecto HH:MM.',
                'Hora_fin.min' =>' Formato de hora incorrecto HH:MM.',
                'Hora_fin.regex' =>' Formato de hora incorrecto HH:MM.',
                'ruc.required' => ' El número ruc ingresado no es válido.',
                'ruc.min' => ' El número ruc ingresado debe debe tener :min caracteres numéricos.',
                'ruc.max' => ' El número ruc ingresadodebe debe tener :max caracteres numéricos.',
            ];
                $this->validate($request,$reglas,$messages);
                
                $negocioactual=DB::table('admnegocio')
                ->join('users', 'admnegocio.idusuario', '=', 'users.id')
                ->join('localnegocio','admnegocio.idlocalnegocio','=','localnegocio.id')
                ->join('tiponegocio','localnegocio.idtiponegocio','=','tiponegocio.id')
                ->select('localnegocio.nombrenegocio','localnegocio.idtiponegocio','localnegocio.id')
                ->where('users.id', '=',auth()->user()->id)
                ->first();
               
                $localnegocio= LocalNegocio::find($negocioactual->id);
               
                $localnegocio->fill([
                    'nombrenegocio'=>$negocioactual->nombrenegocio,
                    'ruc'=>$request->ruc,
                    'latitud'=>$request->latitud,
                    'longitud'=>$request->longitud,
                    'direccion'=>$request->direccion,
                    'descripcion'=>$request->descripcion,
                    'hora_inicio'=>$request->Hora_inicio,
                    'hora_fin'=>$request->Hora_fin,
                    'idtiponegocio'=>$negocioactual->idtiponegocio,
                    'telefono'=>$request->telefono,
                ]);
               
                $localnegocio->save();
                Session::flash('message','Ha registrado correctamente su negocio');
                return view('infoempresa.operacion');
                   
        }
        catch(Exception $e){
          
            return $e->getMessage();
        }
     
    }
    public function revisarnegocio(){

        try{
            $idnegocioactual=DB::table('admnegocio')
            ->join('users', 'admnegocio.idusuario', '=', 'users.id')
            ->select('admnegocio.idlocalnegocio')->where('users.id',auth()->user()->id)
            ->first();
           
            
            if($idnegocioactual!=null){
                $negocio=DB::table('localnegocio')
                ->select('id','nombrenegocio','ruc','descripcion','telefono','hora_inicio','hora_fin','direccion')
                ->where('id',$idnegocioactual->idlocalnegocio)
                ->get();
                
                return response()->json($negocio);
            }
            else{
                $nada=false;
                return response()->json($nada);
            }
        }catch(Exception $e){
          
            return $e->getMessage();
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
    public function eliminarnegocio($id)
    {
        try{
            $localnegocio=new LocalNegocio();
            $datostiponegocio=DB::table('localnegocio')
            ->select('nombrenegocio','idtiponegocio')
            ->where('id',$id)
            ->first();
            $localnegocio= LocalNegocio::find($id);
    
             $localnegocio->fill([
                'nombrenegocio'=>$datostiponegocio->nombrenegocio,
                'ruc'=>null,
                'latitud'=>null,
                'longitud'=>null,
                'descripcion'=>null,
                'hora_inicio'=>null,
                'hora_fin'=>null,
                'idtiponegocio'=>$datostiponegocio->idtiponegocio,
                'telefono'=>null,
            ]);
           
            $localnegocio->save();
            return response()->json([
                "mensaje"=>"Se elimino la informacion del negocio"
            ]);
        }catch(Exception $e){
          
            return $e->getMessage();
        }
        
    }
}
