<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class USerController extends Controller
{
    /*
    * Lista los Usuarios de la Tabla User
    */
    public function index()
    {

	   	//$users = User::all();
    	
    	//$users = DB::table('users')->get();
    	$users = User::all();

    	//dd($users);

    	//if(request()->has('empty')) {
    	//	$users = [];
    	//*} else  {
    	
    	//$users = User::All()->pluck('name');
    	//}
    	/*$users = [
    		'Joel',
    		'Ellie',
    		'Tess',
    		'Tommy',
    		'Bill',
    		'<script>alert("Clicker")</script>',
    	];*/

    	// Distintas Formas de Enviar Parametros a las Vistas
    	// Como Segundo Parametro en forma de Array Asociativo
    	/* return view('users', [
    	 	'Users' =>  $users,
    	 	'title' => 'Listado de Usuarios'
    	 ]);*/

		// Con la Sentencia With en forma de Array Asociativo
    	/*return view('users')
    	 	->with([
    	 	'Users' =>  $users,
    	 	'title' => 'Listado de Usuarios'
    	 ]);*/
		// Con la Sentencia With con With Anidados por Parametro Enviado
    	/*return view('users')
    	 	->with('Users', $users)
    	 	->with('title','Listado de Usuarios');*/

    	// Despliega los Valores de las Variables Enviadas
    	//dd(compact('title','users'));

		$title = 'Listado de Usuarios';
    	return view('users.index', compact('title','users'));
    }
    /*
    * Muestra los Datos de un Usuario
    */
    public function show(User $user)
    {

    	// Mostrar Usuario Utilizando FindOrFail
    	// $user = User::findOrFail($id);

    	//if ($user == null) {
    	//	return response()->view('errors.404', [], 404);
    	//}

    	$title = 'Consulta de Usuarios';
    	return view('users.show',compact('user','title'));
    }
    /*
    * Formulario de Captura de Datos de un Usuario (GET)
    */
    public function create()
    {
    	$title = 'Crear Usuarios';
    	return view('users.create',compact('title'));
    }
    /*
    * Formulario de Edicion de un Usuario (GET)
    */
    public function edit(User $user){
    	$title = 'Crear Usuarios';
    	return view('users.edit',compact('user','title'));
    }
    /*
    * Guarda los Datos de un Usuario en la Table (POST)
    */
    public function store()
    {
    	$data = request()->validate([
    		'name' => 'required',
    		'email' => 'required|email|unique:users,email',
    		//'email' => ['required','email'], Tambien se puede Especificar como Array
    		'password' => 'required|min:6',
    	] , [
    		'name.required' => 'El Campo Nombre es Requerido',
    		'email.required' => 'El Campo Email es Requerido',
    		'email.email' => 'Formato de email invalido',
    		'email.unique' => 'Email duplicado en la Base de Datos',
    		'password.required' => 'El Campo Password es Requerido',
    		'password.min' => 'El password debe tener mas de 5 caracteres'
    	]);
  //  	if (empty($data['name']))
  //   		return redirect()->route('users.create')->withErrors([
  //  			'name' => 'El Campo Nombre es Obligatorio',
  //  	]);

    	User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data[('password')]),
        ]);

    	return redirect()->route('users.index');
    //  Si queremos desplegar los datos introducidos anteriormente	
	//  return redirect()->route('users.index')->withInput();
    }

    public function update(User $user)
    {


    	//$data = request()->all();
    	$data = request()->validate([
    		'name' => 'required',
    		'email' => ['required','email',
    					Rule::unique('users')->ignore($user)],
    		'password' => 'required|min:6',
    	]);

    	$data['password'] = bcrypt($data['password']);

    	$user->update($data);
/*    	$data = request()->validate([
    		'name' => 'required',
    		'email' => 'required|email|unique:users,email',
    		//'email' => ['required','email'], Tambien se puede Especificar como Array
    		'password' => 'required|min:6',
    	] , [
    		'name.required' => 'El Campo Nombre es Requerido',
    		'email.required' => 'El Campo Email es Requerido',
    		'email.email' => 'Formato de email invalido',
    		'email.unique' => 'Email duplicado en la Base de Datos',
    		'password.required' => 'El Campo Password es Requerido',
    		'password.min' => 'El password debe tener mas de 5 caracteres'
    	]);
  //  	if (empty($data['name']))
  //   		return redirect()->route('users.create')->withErrors([
  //  			'name' => 'El Campo Nombre es Obligatorio',
  //  	]);

    	User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data[('password')]),
        ]);*/

    	return redirect()->route('users.show',['user' => $user]);
    //  Si queremos desplegar los datos introducidos anteriormente	
	//  return redirect()->route('users.index')->withInput();
    }
}
