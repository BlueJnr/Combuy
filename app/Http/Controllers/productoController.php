<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tipolocalproducto;
use App\TipoProd;
use App\Producto;
use Session;
use DB;
use App\sugerencias;
use App\ProductoLocal;
use App\LocalNegocio;
use App\prodnegocio;
use Validator;
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
        ->paginate(5);
        //return response()->json($productos);
        return view('ProductoOperaciones.listaproductos')->with('productos',$productos);
        
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
        $reglas = [
            'precio' => ['required','min:4','max:5','regex:/([?1234567890][.][0-9][0-9])+$/'], 
            'stock' => ['required','max:3','regex:/^[0-9]+$/'],
          ];
          $messages = [
            'precio.required' => 'No ha ingresado el precio.',
            'precio.min' => 'Formato de precio incorrecto.',
            'precio.max' => 'Formato de precio incorrecto.',
            'precio.regex' => 'Formato de precio incorrecto.',
            'stock.required' => 'No ha ingresado el stock.',
            'stock.regex' => 'Formato de stock incorrecto.',
            'stock.max' => 'Cantidad de stock muy grande por unidad de producto.',
        ];
           // $validacion=$this->validate($request,$reglas,$messages);
            
            $validator = Validator::make($request->all(),$reglas,$messages);
            
            if ($validator->passes()) {

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
                if($prodexistente){
                    return response()->json(['success' => 'false']);
                }
                else{
                    $prodnegocio->idlocalnegocio=$idnegocioactual->idlocalnegocio;
                    $prodnegocio->idproductolocal=$request->id;
                    $prodnegocio->precio=$request->precio;
                    $prodnegocio->stock=$request->stock;
                    $prodnegocio->save();
                    return response()->json(['success' => 'true']); 
                }
            }
            return response()->json(['errors' => $validator->errors()]);
    }
  
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $sugerencia= new sugerencias();
        $tipolocalproducto=new tipolocalproducto();
        $tipoproducto=TipoProd::All();


        $reglas = [
            'tiponego' => 'required',
            'nombre' => ['required','max:20','string'],
            'descripcion' =>['required','max:50','string'],
        ];
          $messages = [
            'nombre.max' => ' El nombre del producto ingresado es muy grande.',
            'nombre.string' => ' Solo caracteres alfabeticos.',
            'descripcion.string' => ' Solo caracteres alfabeticos.',
        ];
        $validator = Validator::make($request->all(),$reglas,$messages);
        if($validator->passes()){
            $idlocalnegocio=DB::table('admnegocio')
        ->select('idlocalnegocio')
            ->where('idusuario', auth()->user()->id)
            ->first();
            

            $tipolocalproducto=DB::table('tipolocalproducto')->where('nombre',$request->tiponego)->first();

            $sugerencia->nomproducto=$request->nombre;
            $sugerencia->descripcion=$request->descripcion;
            $sugerencia->idtipolocalproducto=$tipolocalproducto->id;
            $sugerencia->idtipoproducto=$request->tipoproducto;
            $sugerencia->idlocalnegocio=$idlocalnegocio->idlocalnegocio;
            $sugerencia->save();
            
            Session::flash('message','Se ha enviado la sugerencia, Espere');
            return view('ProductoOperaciones.registProducto',compact('tipoproducto'));
        }else{
            return view('ProductoOperaciones.registProducto',compact('tipoproducto'));
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
