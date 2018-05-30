<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marca;
use App\Caracteristica;
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
        return view('ProductoOperaciones.registProducto');
    }
    public function selecionnegocio($tipo)
    {
        
        $idnegocioactual=DB::table('admnegocio')
        ->join('users', 'admnegocio.idusuario', '=', 'users.id')
        ->select('admnegocio.idlocalnegocio')->where('users.id',auth()->user()->id)
        ->first();
        
        $productos=DB::table('productolocal')
        ->join('marca','productolocal.idmarca','=','marca.id')
        ->join('tipoproducto','productolocal.idtipoproducto','=','tipoproducto.id')
        ->select('productolocal.id','productolocal.nomproducto','tipoproducto.nomtipo','marca.nommarca','productolocal.descripcion')
        ->where('productolocal.tiponegocio',$tipo)
        ->get();
        return response()->json($productos);
        
    }
    public function revisarproductos($tipo)
    {
        $idnegocioactual=DB::table('admnegocio')
        ->join('users', 'admnegocio.idusuario', '=', 'users.id')
        ->select('admnegocio.idlocalnegocio')->where('users.id',auth()->user()->id)
        ->first();
        
        if($idnegocioactual!=null){
            $productos=DB::table('prodnegocios')
            ->join('productolocal','prodnegocios.idproductolocal','=','productolocal.id')
            ->join('tipoproducto','productolocal.idtipoproducto','=','tipoproducto.id')
            ->join('marca','productolocal.idmarca','=','marca.id')
            ->select('productolocal.id','productolocal.nomproducto','tipoproducto.nomtipo','marca.nommarca','productolocal.descripcion')
            ->where([
                ['productolocal.tiponegocio', '=',$tipo],
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
            return response()->json($prodexistente);
            Session::flash('message','Usted ya registró ese producto');
        }else{
             
            $prodnegocio->idlocalnegocio=$idnegocioactual->idlocalnegocio;
            $prodnegocio->idproductolocal=$request->id;
            $prodnegocio->precio=$request->precio;
            $prodnegocio->stock=$request->stock;
            $prodnegocio->save();
            if($request->ajax()){
           
                return response()->json([
                    "mensaje"=>$request->all()
                     
                ]);
                Session::flash('message','Productos registrados correctamente');
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
        
        $productolocal=new ProductoLocal();
        $marca=new Marca();
        $tipoprod=new TipoProd();

        if($request->tiponegocio!=null && $request->tipoproducto!=null){
            
            $prodexistente=DB::table('productolocal')->where('nomproducto',$request->nombre )->exists();
            $marcaexistente=DB::table('marca')->where('nommarca',$request->marca )->exists();
            if($prodexistente==false){
                $marca->nommarca=$request->marca;
                $marca->save();
                $tipoprod->nomtipo=$request->tipoproducto;
                $tipoprod->save();
                $productolocal->nomproducto=$request->nombre;
                $productolocal->descripcion=$request->descripcion;
                $productolocal->tiponegocio=$request->tiponegocio;
                $productolocal->idtipoproducto=$tipoprod->id;
                $productolocal->idmarca=$marca->id;
                $productolocal->save();
                return response()->json([
                        "mensaje"=>'Producto registrado correctamente'
                    ]);
                Session::flash('message','Producto registrado correctamente');
            }else{
                return response()->json([
                        "mensaje"=>'Producto existente'
                    ]);
                Session::flash('message','Producto existente');
            }
        }else{
            Session::flash('message','No se registro el producto');
            return response()->json([
                "mensaje"=>"No se registro el producto"
            ]);
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
