<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Session;


class usuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('usuario.infousuario');
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
    public function usuarioedit(Request $request)
    {
       
            $reglas = [
                'name' => ['required','max:50','regex:/^[A-Za-z\s]+$/'],
                'lastname' => ['required','max:50','regex:/^[A-Za-z\s]+$/'],
                'email' => 'required|string|email|max:255',
            ]; 
            $messages = [
            
            'name.max' => 'El nombre es muy grande.',
            'name.required' => 'El nombre es obligatorio.',
            'name.regex' => 'Formato de nombre incorrecto.',
            'lastname.regex' => 'Formato de apellido incorrecto.',
            'lastname.required' => 'El apellido es obligatorio.',
            'lastname.max' => 'El apellido es muy grande.',
            'email.required' => 'El email es obligatorio.',
            ];
            $usuario=User::find(auth()->user()->id);
           
            $this->validate($request,$reglas,$messages);
            
            
            $usuario->fill([
                'name'=>$request->name,
                'lastname'=>$request->lastname,
                'dni'=>$request->dni,
                'email'=>$request->email,
            ]);
            $usuario->save();
            Session::flash('message','Ha editado correctamente sus datos');
            return view('usuario.infousuario');
        
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
        dd($id);
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
