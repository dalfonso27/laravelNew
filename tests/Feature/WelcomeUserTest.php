<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeUserTest extends TestCase
{
    /**
    * @test 
    **/
    function it_welcome_users_with_nickname()
    {
        $this->get('saludos/duilio/silence')
            ->assertStatus(200)
            ->assertSee("Bienvenido Duilio, su apodo es silence");
    }
    /**
    * @test 
    **/
    function it_welcome_users_without_nickname()
    {
        $this->get('saludos/duilio')
            ->assertStatus(200)
            ->assertSee("Bienvenido Duilio, no tienes apodo");
    }
}
