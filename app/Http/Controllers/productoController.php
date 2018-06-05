<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tipolocalproducto;
use App\TipoProd;
use App\Producto;
use Session;
use DB;
use App\ProductoLocal;
use App\LocalNegocio;
use App\prodnegocio;
class productoController extends Controller
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
        return view('ProductoOperaciones.revisarProductos');
    }
    public function registrarproducto()
    {
        //return view('ProductoOperaciones.registProducto');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoproducto=TipoProd::All();
        return view('ProductoOperaciones.registProducto',compact('tipoproducto'));
    }
    public function selecionnegocio($tipo)
    {
        
        $idnegocioactual=DB::table('admnegocio')
        ->join('users', 'admnegocio.idusuario', '=', 'users.id')
        ->select('admnegocio.idlocalnegocio')->where('users.id',auth()->user()->id)
        ->first();
        
        $productos=DB::table('productolocal')
        ->join('tipoproducto','productolocal.idtipoproducto','=','tipoproducto.id')
        ->join('tipolocalproducto','productolocal.idtipolocalproducto','=','tipolocalproducto.id')
        ->select('productolocal.id','productolocal.nomproducto','productolocal.descripcion','tipoproducto.nomtipo','tipolocalproducto.nombre')
        ->where('tipolocalproducto.nombre',$tipo)
        ->get();
        
        return response()->json($productos);
        
    }
    public function revisarproductos($tipo)
    {
        $idnegocioactual=DB::table('admnegocio')
        ->join('users', 'admnegocio.idusuario', '=', 'users.id')
        ->select('admnegocio.idlocalnegocio')->where('users.id',auth()->user()->id)
        ->first();
        
        $tipolocalproducto=DB::table('tipolocalproducto')->where('nombre',$tipo)->first();
        
        if($idnegocioactual!=null){
            $productos=DB::table('prodnegocios')
            ->join('productolocal','prodnegocios.idproductolocal','=','productolocal.id')
            ->join('tipoproducto','productolocal.idtipoproducto','=','tipoproducto.id')
            ->join('tipolocalproducto','productolocal.idtipolocalproducto','=','tipolocalproducto.id')
            ->select('productolocal.id','productolocal.nomproducto','tipoproducto.nomtipo','productolocal.descripcion')
            ->where([
                ['productolocal.idtipolocalproducto', '=',$tipolocalproducto->id],
                ['prodnegocios.idlocalnegocio', '=',$idnegocioactual->idlocalnegocio],])
            ->get();
            return response()->json($productos);
        }
        else{
            $nada=false;
            return response()->json($nada);
        }
        
        
    }
    public function registro(Request $request){
        

        /*
        $reglas = [
            'precio' => ['required','min:3','max:5','regex:/($[0-9,]+(.[0-9]{2})?)/'],
            'stock' => ['required','min:9','max:9'],
          ];
          $messages = [
            'precio.required' => 'No ha ingresado el precio.',
            'precio.min' => 'Formato de precio incorrecto.',
            'precio.max' => 'Formato de precio incorrecto.',
            'precio.regex' => 'Formato de precio incorrecto.',
        ];
            $this->validate($request,$reglas,$messages);
            */

        $prodnegocio=new prodnegocio();
        $productolocal=new ProductoLocal();
        
        $idnegocioactual=DB::table('admnegocio')
        ->join('users', 'admnegocio.idusuario', '=', 'users.id')
        ->select('admnegocio.idlocalnegocio')->where('users.id',auth()->user()->id)
        ->first();

        $prodexistente=DB::table('prodnegocios')
        ->where([
            ['idproductolocal','=',$request->id],
            ['prodnegocios.idlocalnegocio', '=',$idnegocioactual->idlocalnegocio],])
        ->exists();
        
        if($prodexistente)
        {
            //Session::flash('message','Usted ya registró ese producto');
            return response()->json([
                "mensaje"=>'Usted ya registró ese producto'
            ]);
            
        }else{
             
            $prodnegocio->idlocalnegocio=$idnegocioactual->idlocalnegocio;
            $prodnegocio->idproductolocal=$request->id;
            $prodnegocio->precio=$request->precio;
            $prodnegocio->stock=$request->stock;
            $prodnegocio->save();
            if($request->ajax()){
           
                return response()->json([
                    "mensaje"=>'Producto registrado correctamente'
                     
                ]);
                //Session::flash('message','Productos registrados correctamente');
            }
        }
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
            'tiponego' => 'required',
            'nombre' => 'required|max:20',
            'descripcion' => 'required|max:50',
          ];
          $messages = [
            'nombre.max' => ' El nombre del producto ingresado es muy grande.',
        ];
            $this->validate($request,$reglas,$messages);
        

        $productolocal=new ProductoLocal();
        $tipolocalproducto=new tipolocalproducto();

        $prodexistente=DB::table('productolocal')->where('nomproducto',$request->nombre)->exists(); 
        
        if(!$prodexistente){
            
            $tipolocalproducto=DB::table('tipolocalproducto')->where('nombre',$request->tiponego)->first();
            $productolocal->nomproducto=$request->nombre;
            $productolocal->descripcion=$request->descripcion;
            $productolocal->idtipolocalproducto=$tipolocalproducto->id;
            $productolocal->idtipoproducto=$request->tipoproducto;
            $productolocal->save();

            return response()->json([
                    "mensaje"=>'Producto registrado correctamente'
                ]);
            //Session::flash('message','Producto registrado correctamente');
        }else{
            if($request->ajax()){
           
                return response()->json([
                    "mensaje"=>'Producto existente, Ya esta registrado'
                ]);    
            // Session::flash('message','Producto existente');
            }
            $tipoproducto=TipoProd::All();
            return view('ProductoOperaciones.registProducto',compact('tipoproducto'));
            Session::flash('message','El producto ya esta registrado');
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
       
    }
    public function eliminarproducto($id)
    {
        $prodnegocio=new prodnegocio();

        $idnegocioactual=DB::table('admnegocio')
        ->join('users', 'admnegocio.idusuario', '=', 'users.id')
        ->select('admnegocio.idlocalnegocio')
        ->where('users.id',auth()->user()->id)
        ->first();
       
        $buscardatoseliminado=DB::table('prodnegocios')
        ->join('productolocal','prodnegocios.idproductolocal','=','productolocal.id')
        ->select('prodnegocios.idproductolocal','prodnegocios.idlocalnegocio')
        ->where([
            ['prodnegocios.idproductolocal','=',$id],
            ['prodnegocios.idlocalnegocio', '=',$idnegocioactual->idlocalnegocio],])
        ->first();
        
        $eliminado=DB::table('prodnegocios')
        ->where([
            ['prodnegocios.idproductolocal','=',$buscardatoseliminado->idproductolocal],
            ['prodnegocios.idlocalnegocio', '=',$buscardatoseliminado->idlocalnegocio],])
        ->delete();
        
        return response()->json([
            "mensaje"=>"Se elimino el producto del negocio"
        ]);
    }
}
