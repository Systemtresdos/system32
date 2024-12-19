<?php

use App\Models\Usuario;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticacionTest extends TestCase
{
    use RefreshDatabase;

    public function login_screen_can_be_rendered(){
        $response = $this->get('/login');
        $response->assertStatus(200);
    }
    public function users_can_authenticate_using_the_login_screen(){
        $user = Usuario::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
    public function users_can_not_authenticate_with_invalid_password(){
        $user = Usuario::factory()->create();
        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);
        $this->assertGuest();
    }
    public function users_can_logout(){
        $user = Usuario::factory()->create();

        $response = $this->actingAs($user)->post('/logout');
    
        $this->assertGuest();
        $response->assertRedirect('/');
    }
}