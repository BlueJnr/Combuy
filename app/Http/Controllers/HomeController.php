<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $negocioactual=DB::table('admnegocio')
        ->join('users', 'admnegocio.idusuario', '=', 'users.id')
        ->join('localnegocio','admnegocio.idlocalnegocio','=','localnegocio.id')
        ->select('descripcion','telefono')
        ->where('users.id', '=',auth()->user()->id)
        ->first();
        return view('home')->with('dato',$negocioactual);
    }
}
