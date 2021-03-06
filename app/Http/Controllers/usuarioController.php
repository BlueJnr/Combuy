<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Session;
use Exception;


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
    public function datauser(){
        
        return view('usuario.infocuenta');
    }
    public function usuarioedit(Request $request)
    {
        try{
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
                'email'=>$request->email,
            ]);
            $usuario->save();
            Session::flash('message','Ha editado correctamente sus datos');
            return redirect("usuario");
        
        }catch(Exception $e){
          
          return $e->getMessage();
        }
            
        
    }
    public function datosusuario(Request $request)
    {
      try{
       $usuario=User::find(auth()->user()->id);
            if($usuario->username==$request->username){
                $reglas = [
                    'username' => 'required|string|max:50',
                    'password' => 'required|string|min:6|confirmed',
                  ]; 
                $messages = [
                    'username.max' => 'El nombre de usuario es muy grande',
                    'username.required' => 'El nombre de usuario es obligatorio',
                ];
            }else{
                $reglas = [
                    'username' => 'required|string|max:50|unique:users',
                    'password' => 'required|string|min:6|confirmed',
                  ]; 
                $messages = [
                    'username.unique' => 'Usuario ya registrado,porfavor ingrese otro.',
                    'username.max' => 'El nombre de usuario es muy grande',
                ];
            }
           
            $this->validate($request,$reglas,$messages);
            
            $usuario->fill([
                'username'=>$request->username,
                'password' => bcrypt($request->password),
            ]);
            $usuario->save();
            Session::flash('message','Ha editado correctamente sus datos');
            return redirect()->back();
            
       
      }catch(Exception $e){
        
        return $e->getMessage();
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
