<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Profession;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // No se Puede Truncar un campo que hace referencia a una Llave Foraenea

    	profession::create([
    		'title' => 'Desarrollador Backend',
    	]);

 //       DB::table('professions')->insert([
 //       	'title' => 'Desarrollador Backend',
 //       ]);

        profession::create([
        	'title' => 'Desarrollador Frontend',
        ]);

        profession::create([
        	'title' => 'Diseñador Web',
        ]);

        factory(Profession::class, 17)->create();
        
    }
}
