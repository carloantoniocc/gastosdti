<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	
	/**
	 * Sobreescribe los siguientes métodos para incluir validación de usuario activo y registro de sesion de establecimiento
	 */
	protected function credentials(Request $request)
    {
        //registra session de usuario
		session(['establecimiento' => $request->establecimiento]);
		//verifica que usuario está activo
		return array_merge($request->only($this->username(), 'password'), ['active' => 1]);
    }
	
	/**
	 * Genera lista dinamica de ESTABLECMIENTOS por USUARIOS
	 *
	 * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
	 */
	public function getEstab(Request $request,$mail) {

		if($request->ajax()){
			$id = User::where('email','=',$mail)->first(); 
			
			$user = User::find($id->id);	 
			
			$establecimientos = $user->establecimientos()->get();
			
			return response()->json($establecimientos);
		}
	}
}
