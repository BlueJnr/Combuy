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
        return view('ProductoOperaciones.registProducto');
    }

    public function revisarproductos()
    {
        
        $prod=DB::table('producto')
        ->join('tipoprod', 'producto.TipoProd_idTipoProd', '=', 'tipoprod.idTipoProd')
        ->join('marca', 'producto.Marca_idProducto_caract', '=', 'marca.idProducto_Caract')
        ->select('producto.Nom_producto', 'tipoprod.NombreProducto','marca.nombre_Marca')
        ->get();
        return response()->json($prod->toArray());

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
        $marca=new Marca();
        $caracte=new Caracteristica();
        $tipoprod=new TipoProd();
        $producto=new Producto();
        $productolocal=new ProductoLocal();
        $localnegocio=new LocalNegocio();
        
        $idnegocioactual=DB::table('admnegocio')
        ->join('users', 'admnegocio.Usuario_idUsuario', '=', 'users.id')
        ->select('admnegocio.idNegocio')->where('users.id',auth()->user()->id)
        ->first();
        
        $caracte->caracteristica=$request->input('caracteristica');
        $caracte->save();
        $tipoprod->NombreProducto=$request->input('tipo');
        $tipoprod->save();
        $marca->nombre_Marca =$request->input('marca');
        $marca->save();

        $producto->Nom_producto=$request->input('nombre');
        $producto->TipoProd_idTipoProd=$tipoprod->idTipoProd;
        $producto->Marca_idProducto_caract=$marca->idProducto_Caract;
        $producto->Caracteristica_idCarProd=$caracte->idCarProd;
        $producto->save();

        $productolocal->precio=$request->input('precio');
        $productolocal->LocalNegocio_idNegocio=$idnegocioactual->idNegocio;
        $productolocal->Producto_idProducto=$producto->idProducto;
        $productolocal->save();


        Session::flash('message','Producto registrado correctamente');

        return view('ProductoOperaciones.registProducto');

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
        //
    }
}
