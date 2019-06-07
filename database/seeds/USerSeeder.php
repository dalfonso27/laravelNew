<?php

use App\Models\User;
use App\Models\Profession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class USerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Construccion de SQL con Facade DB::insert (select, delete, update, statement) pueden ser usados
        // Devuelve in array asociativo 
        // $professions = DB::select('SELECT id FROM professions WHERE title = "Desarrollador Backend"');	

    	// Construccion de SQL con Facade DB pero evitando Inyeccion esta es la mejor manera una manera segura
    	// de Hacer Consultas en Laravel, Laravel se encarga de la Seguridad
        // $professions = DB::select('SELECT id FROM professions WHERE title = ?',["Desarrollador Backend"]);

        // Utilizando el Constructor de Consultas de Laravel mas sencillo y mas leible y con seguridad
        // Devuelve una interfaz orientada a objetos y funciones para trabajar con las colecciones
        //$professions = DB::table('professions')->select('id')->take(1)->get();

		//$professions = DB::table('professions')
        //				->select('id')
        //				->where('title','=','Desarrollador Backend')
        //				->first();

		//$professionId = DB::table('professions')
        //				->where('title','=','Desarrollador Backend')
        //				->value('id');

    	$professionId = Profession::whereTitle('Desarrollador Backend')->value('id');

    	//dd($professionId);

        User::create([
        	'name' => 'Duilio Palacios',
        	'email' => 'duilio@styde.net',
        	'password' => bcrypt('laravel'),
        	'profession_id' => $professionId,
            'is_admin' => true,
        ]);

        User::create([
            'name' => 'Daphne Duncan',
            'email' => 'duncan27@styde.net',
            'password' => bcrypt('laravel27'),
            'profession_id' => $professionId,
        ]);

        User::create([
            'name' => 'David Duncan',
            'email' => 'dduncan29@styde.net',
            'password' => bcrypt('laravel29'),
            'profession_id' => $professionId,
        ]);


        factory(User::class)->create([
            'profession_id' => $professionId,
        ]);

        factory(User::class,48)->create();
    }
}
