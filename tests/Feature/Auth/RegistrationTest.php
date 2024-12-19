<?php

use App\Providers\RouteServiceProvider;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function registration_screen_can_be_rendered(){    
        $response = $this->get('/register');    
        $response->assertStatus(200);
    }

    public function new_users_can_register(){    
        $response = $this->post('/register', [
            'nombre' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
    
        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}


