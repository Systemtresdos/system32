<?php

use App\Models\Usuario;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ProgileTest extends TestCase
{
    use RefreshDatabase;

    public function profile_page_is_displayed(){
        $user = Usuario::factory()->create();
        
        $response = $this
            ->actingAs($user)
            ->get('/profile');
        
        $response->assertOk();
    }
    public function profile_information_can_be_updated(){
        $user = Usuario::factory()->create();
        
        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'nombre' => 'Test User',
                'email' => 'test@example.com',
            ]);
        
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');
        
        $user->refresh();
        
        $this->assertSame('Test User', $user->name);
        $this->assertSame('test@example.com', $user->email);
        $this->assertNull($user->email_verified_at);
    }
    public function email_verification_status_is_unchanged_when_the_email_address_is_unchanged(){
        $user = Usuario::factory()->create();
        
        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'nombre' => 'Test User',
                'email' => $user->email,
            ]);
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');
        $this->assertNotNull($user->refresh()->email_verified_at);
    }
    public function user_can_delete_their_account(){
        $user = Usuario::factory()->create();
        
        $response = $this
            ->actingAs($user)
            ->delete('/profile', [
                'password' => 'password',
            ]);
        
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');
        
        $this->assertGuest();
        $this->assertNull($user->fresh());
    }
    public function correct_password_must_be_provided_to_delete_account(){
        $user = Usuario::factory()->create();
        $response = $this
            ->actingAs($user)
            ->from('/profile')
            ->delete('/profile', [
                'password' => 'wrong-password',
            ]);
        $response
            ->assertSessionHasErrorsIn('userDeletion', 'password')
            ->assertRedirect('/profile');
    
        $this->assertNotNull($user->fresh());
    }
}

