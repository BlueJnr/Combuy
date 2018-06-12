<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\AdmiNegocio;
use App\LocalNegocio;
use App\TipoNegocio;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
  //  protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        
        $reglas = [
            'name' => ['required','max:50','regex:/^[A-Za-z\s]+$/'],
            'lastname' => ['required','max:50','regex:/^[A-Za-z\s]+$/'],
            'dni' => ['required','min:8','max:8','regex:/^[0-9]+$/','unique:users'],
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:50|unique:users',
            'password' => 'required|string|min:6|confirmed',
          ]; 
          $messages = [
            'dni.regex' => 'Formato DNI incorrecto.',
            'dni.unique' => 'DNI ya registrado, porfavor ingrese otro.',
            'dni.max' => 'DNI debe ser de 8 números',
            'dni.min' => 'DNI debe ser de 8 números',
            'name.max' => 'El nombre es muy grande.',
            'name.regex' => 'Formato de nombre incorrecto.',
            'name.string' => 'El nombre no puede llevar números.',
            'lastname.regex' => 'Formato de apellido incorrecto.',
            'lastname.max' => 'El apellido es muy grande.',
            'email.unique' => 'Email ya registrado,porfavor ingrese otro.',
            'username.unique' => 'Usuario ya registrado,porfavor ingrese otro.',
            'username.max' => 'El nombre de usuario es muy grande',
            'password.min' => 'La contraseñana debe tener minimo 6 caraceteres.',
        ];
        return Validator::make($data,$reglas,$messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //IR A RegistersUsers donde se agregó los demos campos
        return User::create([
            'username' => $data['username'],
            'role' =>'user',
            'password' => bcrypt($data['password']),
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'dni' => $data['dni'],
            'email' => $data['email']
        ]);
    }
}
