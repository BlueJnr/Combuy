<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\sugerencias;
use App\prodnegocio;
use App\ProductoLocal;
use Mail;
use DB;
use Session;
use Validator;

class administradorController extends Controller
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
        return view('administrador.homeadmin');
    }
    
    public function revisarsugerencias($tipoproducto){
        
        try{
            $sugerencia=new sugerencias();
            $id_tipoproducto=DB::table('tipoproducto')
            ->select('id')
            ->where('nomtipo',$tipoproducto)
            ->first();
            $sugerencia=DB::table('sugerencias')
            ->join('tipolocalproducto','sugerencias.idtipolocalproducto','=','tipolocalproducto.id')
            ->join('tipoproducto','sugerencias.idtipoproducto','=','tipoproducto.id')
            ->select('sugerencias.id','sugerencias.nomproducto','sugerencias.descripcion','tipolocalproducto.nombre','tipoproducto.nomtipo')
            ->where('sugerencias.idtipoproducto', $id_tipoproducto->id)
            ->paginate(5);
            return view('administrador.listasugerencia')->with('sugerencias',$sugerencia);
        }catch(Exception $e){
          
            return $e->getMessage();
        }
       
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $prodnegocio=new prodnegocio();
            $productolocal=new ProductoLocal();
            $sugerencia=new sugerencias();
            $producto=new ProductoLocal();
           
    
            $reglas = [
                'etiqueta' => 'required|max:50',
              ];
              $messages = [
                'etiqueta.max' => ' El nombre de la etiqueta ingresada es muy grande.',
                'etiqueta.required' => ' El nombre de la etiqueta es obligatorio.',
            ];
           
            $validator = Validator::make($request->all(),$reglas,$messages);
            
            if ($validator->passes()){
                $tipolocalproducto=DB::table('sugerencias')
                ->where('id',$request->id)
                ->first();
                $idnegocioactual=DB::table('admnegocio')
                    ->join('users', 'admnegocio.idusuario', '=', 'users.id')
                    ->select('users.id','users.email')->where('admnegocio.idlocalnegocio', $tipolocalproducto->idlocalnegocio)
                    ->first();
                   
                $email=$idnegocioactual->email;
               
                
                $dataemail=array(
                    'name'=>"Curso laravel",
                );
                $existente=DB::table('productolocal')
                ->where('nomproducto',$tipolocalproducto->nomproducto)
                ->exists();
    
                if($existente){
                    return response()->json(['success' => 'false']);
                }else{
                    
                    Mail::send('mail.mail',['email' => $idnegocioactual],function($msj) use ($idnegocioactual){
                        $msj->from('admcombuy@gmail.com','Combuy');
                        $msj->to($idnegocioactual->email)->subject('Correo de confirmación');
                    });
                    $producto->nomproducto=$tipolocalproducto->nomproducto;
                    $producto->descripcion=$tipolocalproducto->descripcion;
                    $producto->idtipolocalproducto=$tipolocalproducto->idtipolocalproducto;
                    $producto->idtipoproducto=$tipolocalproducto->idtipoproducto;
                    $producto->etiqueta=$request->etiqueta;
                    $producto->save();
    
                    $sugerencia=DB::table('sugerencias')
                    ->where('id',$request->id)
                    ->delete();
                    return response()->json(['success' => 'true']); 
                }
                
            }else{
                return response()->json(['errors' => $validator->errors()]);
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $sugeren=sugerencias::find($id);
            return response()->json($sugeren);
        }catch(Exception $e){
          
            return $e->getMessage();
        }
        
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
        try{
            $reglas = [
                'nombre' => 'required|max:50',
                'descripcion' => 'required|max:50',
              ];
              $messages = [
                'nomproducto.required' => ' El nombre es obligatorio.',
                'descripcion.required' => ' La descripcion es obligatoria.',
            ];
           
            $validator = Validator::make($request->all(),$reglas,$messages);
            if ($validator->passes()) {
                
               
                if($request->ajax()){
                    $sugeren=sugerencias::find($id);
                    $sugeren->fill([
                        'id'=>$id,
                        'nomproducto'=>$request->nombre,
                        'descripcion'=>$request->descripcion,
                    ]);
                    $resultado=$sugeren->save();
                    if($resultado){
                        return response()->json(['success'=>'true']);
                    }
                    else{
                        return response()->json(['success'=>'false']);
                    }
                }
            }
            return response()->json(['errors' => $validator->errors()]);
        }
        catch(Exception $e){
          
            return $e->getMessage();
        }
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $sugerencia=new sugerencias();
            $sugerencia=DB::table('sugerencias')
            ->where('id',$id)
            ->delete();
            return response()->json(['success' => 'true']);
        }catch(Exception $e){
          
            return $e->getMessage();
        }
        
    }
}
