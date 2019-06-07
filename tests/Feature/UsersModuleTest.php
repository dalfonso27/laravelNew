<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersModuleTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Prueba Automatizada
     * @test
     */
    function it_shows_the_users_list_page()
    {

        factory(User::class)->create([
            'name' => 'Joel',
            'website' => 'thelastofus',
        ]);
        factory(User::class)->create([
            'name' => 'Ellie',
        ]);

        $this->get("/usuarios")
            ->assertStatus(200)
            ->assertSee('Usuarios')
            ->assertSee('Joel')
            ->assertSee('Ellie');
    }
    /**
     * Prueba Automatizada
     * @test
     */
    function it_shows_a_default_message_if_the_users_list_is_empty()
    {

        //DB::table('users')->truncate();

        $this->get("/usuarios")
            ->assertStatus(200)
            ->assertSee('Usuarios')
            ->assertSee('No hay usuarios Registrados');
    }
    /**
     * Prueba Automatizada
     * @test
     */
    function it_loads_the_user_detail_page()
    {

        $user = factory(User::class)->create([
            'name' => 'Duilio Palacios',
        ]);

        $this->get("/usuarios/{$user->id}")
            ->assertStatus(200)
            ->assertSee("Duilio Palacios");
    }
    /**
     * Prueba Automatizada
     * @test
     */
    function it_load_new_user_page()
    {
        $this->get("/usuarios/nuevo")
            ->assertStatus(200)
            ->assertSee("Crear Usuarios");
    }
    /**
     * Prueba Automatizada
     * @test
     */
    function it_loads_error_404_if_user_id_not_found()
    {
        $this->get("/usuarios/999")
            ->assertStatus(404)
            ->assertSee('Pagina no encontrada');
    }
    /**
    * Prueba Automatizada
    * @test
    */
    function it_create_a_new_user()
    {
     
        //$this->withoutExceptionHandling();

        $this->from("/usuarios/nuevo")->post("/usuarios/",[
            'name' => 'Duilio Palacios',
            'email' => 'duilio2520@styde.net',
            'password' => '123456',
        ])->assertRedirect("/usuarios");

        $this->assertDatabasehas('users', [
            'name' => 'Duilio Palacios',
            'email' => 'duilio2520@styde.net'
        ]);
    }
    /**
    * Prueba Automatizada
    * @test
    */
    function the_name_is_required()
    {

        //$this->withoutExceptionHandling();

        $this->from("/usuarios/nuevo")->post("/usuarios/",[
            //'name' => 'Duilio Palacios',
            'email' => 'duilio@styde.net',
            'password' => '123456'
        ])->assertRedirect("/usuarios/nuevo")
          ->assertSessionHasErrors(['name' => 'El Campo Nombre es Requerido']);

        $this->assertEquals(0, User::count());

        $this->assertDatabaseMissing('users',[
            'email' => 'duilio@styde.net'
        ]);
    }
    /**
    * Prueba Automatizada
    * @test
    */
    function the_email_is_required()
    {
        //$this->withoutExceptionHandling();

        $this->from("/usuarios/nuevo")->post("/usuarios/",[
            'name' => 'Duilio Palacios',
            'email' => '',
            'password' => '123456'
        ])->assertRedirect("/usuarios/nuevo")
          ->assertSessionHasErrors(['email']);

        $this->assertEquals(0, User::count());

        $this->assertDatabaseMissing('users',[
            'name' => 'Duilio Palacios'
        ]);
    }
    /**
    * Prueba Automatizada
    * @test
    */
    function the_password_is_required()
    {
        //$this->withoutExceptionHandling();

        $this->from("/usuarios/nuevo")->post("/usuarios/",[
            'name' => 'Duilio Palacios',
            'email' => 'duilio@styde.net',
            'password' => ''
        ])->assertRedirect("/usuarios/nuevo")
          ->assertSessionHasErrors(['password']);

        $this->assertEquals(0, User::count());

        $this->assertDatabaseMissing('users',[
            'name' => 'Duilio Palacios'
        ]);
    }
    /**
    * Prueba Automatizada
    * @test
    */
    function the_email_must_be_valid()
    {
        //$this->withoutExceptionHandling();

        $this->from("/usuarios/nuevo")->post("/usuarios/",[
            'name' => 'Duilio Palacios',
            'email' => 'correo-invalido',
            'password' => '123456'
        ])->assertRedirect("/usuarios/nuevo")
          ->assertSessionHasErrors(['email']);

        $this->assertEquals(0, User::count());

        $this->assertDatabaseMissing('users',[
            'name' => 'Duilio Palacios'
        ]);
    }
    /**
    * Prueba Automatizada
    * @test
    */
    function the_email_must_be_unique()
    {
        //$this->withoutExceptionHandling();

        factory(User::class)->create([
            'name' => 'Duilio Palacios',
            'email' => 'duilio@styde.net',
        ]);

        $this->from("/usuarios/nuevo")->post("/usuarios/",[
            'name' => 'David Duncan',
            'email' => 'duilio@styde.net',
            'password' => '123456'
        ])->assertRedirect("/usuarios/nuevo")
          ->assertSessionHasErrors(['email']);

        $this->assertEquals(1, User::count());

        $this->assertDatabaseMissing('users',[
            'name' => 'David Duncan'
        ]);
    }
        /**
    * Prueba Automatizada
    * @test
    */
    function the_Password_must_have_more_than_6_characters()
    {
        
        //$this->withoutExceptionHandling();

        $this->from("/usuarios/nuevo")->post("/usuarios/",[
            'name' => 'Duilio Palacios',
            'email' => 'correo-invalido',
            'password' => '123'
        ])->assertRedirect("/usuarios/nuevo")
          ->assertSessionHasErrors(['password']);

        $this->assertEquals(0, User::count());

        $this->assertDatabaseMissing('users',[
            'name' => 'Duilio Palacios'
        ]);
    }

    /**
     * Prueba Automatizada
     * @test
     */
    function it_load_user_edit_page()
    {
        
        //$this->withoutExceptionHandling();
        
        $user = factory(User::class)->create([
            'name' => 'Duilio Palacios',
            'email' => 'duilio@styde.net',
        ]);

        $this->get("/usuarios/{$user->id}/editar")
            ->assertStatus(200)
            ->assertViewIs('users.edit')
            ->assertSee("Editar Usuario")
            ->assertViewHas('user', function($viewUser) use ($user) {
                return $viewUser->id === $user->id;
            });
    }
    /**
     * Prueba Automatizada
     * @test
     */
    function it_updates_a_user()
    {
        
        //$this->withoutExceptionHandling();
        
        $user = factory(\App\Models\User::class)->create();

        $this->put("/usuarios/{$user->id}",[
            'name' => 'Duilio Palacios',
            'email' => 'duilio@styde.net',
            'password' => '123456'
        ])->assertRedirect("/usuarios/{$user->id}");

        $this->assertCredentials([
            'name' => 'Duilio Palacios',
            'email' => 'duilio@styde.net',
            'password' => '123456',
        ]);
    }
    /**
    * Prueba Automatizada
    * @test
    */
    function the_name_is_required_when_updating()
    {
        //$this->withoutExceptionHandling();

        $user = factory(\App\Models\User::class)->create();

        $this->from("/usuarios/{$user->id}/editar")->put("/usuarios/{$user->id}",[
            'name' => '',
            'email' => 'duilio@styde.net',
            'password' => '123456'
        ])->assertRedirect("/usuarios/{$user->id}/editar")
          ->assertSessionHasErrors(['name']);

        $this->assertEquals(1, User::count());

        $this->assertDatabaseMissing('users',[
            'name' => 'duilio@styde.net'
        ]);
    }
    /**
    * Prueba Automatizada
    * @test
    */
    function the_email_is_require_when_updating()
    {
        //$this->withoutExceptionHandling();

        $user = factory(\App\Models\User::class)->create();

        $this->from("/usuarios/{$user->id}/editar")->put("/usuarios/{$user->id}",[
            'name' => 'Duilio Palacios',
            'email' => '',
            'password' => '123456'
        ])->assertRedirect("/usuarios/{$user->id}/editar")
          ->assertSessionHasErrors(['email']);

        $this->assertEquals(1, User::count());

        $this->assertDatabaseMissing('users',[
            'name' => 'Duilio Palacios'
        ]);
    }
    /**
    * Prueba Automatizada
    * @test
    */
    function the_password_is_required_when_updating()
    {
        //$this->withoutExceptionHandling();

        $user = factory(\App\Models\User::class)->create();

        $this->from("/usuarios/{$user->id}/editar")->put("/usuarios/{$user->id}",[
            'name' => 'Duilio Palacios',
            'email' => 'duilio@styde.net',
            'password' => ''
        ])->assertRedirect("/usuarios/{$user->id}/editar")
          ->assertSessionHasErrors(['password']);

        $this->assertEquals(1, User::count());

        $this->assertDatabaseMissing('users',[
            'email' => 'duilio@styde.net'
        ]);
    }
    /**
    * Prueba Automatizada
    * @test
    */
    function the_email_must_be_valid_when_updating()
    {
        //$this->withoutExceptionHandling();

        $user = factory(\App\Models\User::class)->create();

        $this->from("/usuarios/{$user->id}/editar")->put("/usuarios/{$user->id}",[
            'name' => 'Duilio Palacios',
            'email' => 'correo-invalido',
            'password' => '123456'
        ])->assertRedirect("/usuarios/{$user->id}/editar")
          ->assertSessionHasErrors(['email']);

        $this->assertEquals(1, User::count());

        $this->assertDatabaseMissing('users',[
            'name' => 'Duilio Palacios'
        ]);
    }
    /**
    * Prueba Automatizada
    * @test
    */
    function the_email_must_be_unique_when_updating()
    {
        
        self::markTestIncomplete();
        return ;
        //$this->withoutExceptionHandling();

        $user = factory(User::class)->create([
            'name' => 'Duilio Palacios',
            'email' => 'duilio@styde.net',
        ]);

        $this->from("/usuarios/{$user->id}/editar")->put("/usuarios/{$user->id}",[
            'name' => 'David Duncan',
            'email' => 'duilio@styde.net',
            'password' => '123456'
        ])->assertRedirect("/usuarios/{$user->id}/editar")
          ->assertSessionHasErrors(['email']);

        $this->assertEquals(1, User::count());

        $this->assertDatabaseMissing('users',[
            'name' => 'David Duncan'
        ]);
    }
        /**
    * Prueba Automatizada
    * @test
    */
    function the_Password_must_have_more_than_6_characters_when_updating()
    {
        
        //$this->withoutExceptionHandling();

        $user = factory(User::class)->create([
            'name' => 'Duilio Palacios',
            'email' => 'duilio@styde.net',
        ]);

        $this->from("/usuarios/{$user->id}/editar")->put("/usuarios/{$user->id}",[
            'name' => 'David Duncan',
            'email' => 'correo-invalido',
            'password' => '123'
        ])->assertRedirect("/usuarios/{$user->id}/editar")
          ->assertSessionHasErrors(['password']);

        $this->assertEquals(1, User::count());

        $this->assertDatabaseMissing('users',[
            'name' => 'David Duncan',
        ]);
    }    

}
