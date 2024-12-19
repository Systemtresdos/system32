<?php

use App\Models\Usuario;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class PasswordConfirmationTest extends TestCase
{
    use RefreshDatabase;

    public function confirm_password_screen_can_be_rendered(){
        $user = Usuario::factory()->create();
        $response = $this->actingAs($user)->get('/confirm-password');
        $response->assertStatus(200);
    }
    public function password_can_be_confirmed(){
        $user = Usuario::factory()->create();
        $response = $this->actingAs($user)->post('/confirm-password', [
            'password' => 'password',
        ]);
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }
    public function password_is_not_confirmed_with_invalid_password(){
        $user = Usuario::factory()->create();

        $response = $this->actingAs($user)->post('/confirm-password', [
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors();
    }
}
