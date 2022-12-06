<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;


/**
 * AuthApiTest
 * 
 * Clase encargada de generar los test automáticos del flujo de Autenticación.
 */
class AuthApiTest extends TestCase
{
    
    use RefreshDatabase;
    
        
    /**
     * test_Requires_Email_And_Login
     *
     * Testea que el servicio de login esté arriba.
     * 
     * @return void
     */
    public function test_Requires_Email_And_Login()
    {
        $this->json('POST', 'api/v1/login')
            ->assertStatus(422);
    }
    
    /**
     * test_User_Logins_Successfully
     *
     * Prueba unitaria encargada de probar el flujo de inicio de sesión y generación del token de autorización, 
     * así como la resolución de los datos. 
     * 
     * @return void
     */
    public function test_User_Logins_Successfully()
    {
        $this->artisan('db:seed');
        $this->artisan('passport:install');

        $payload = ['email' => 'jamahcs@outlook.com', 'password' => 'acceso.jama'];

        $this->json('POST', 'api/v1/login', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expires_at',
                'user' => [
                    'name',
                    'profile_photo_url',
                    'email',
                    'markets'
                ]
            ]);
    }
     
     /**
      * test_Registers_Successfully
      *
      * Test encargado de testear la funcionalidad de registro correctamente, 
      * así como una verificación del flujo y los datos devueltos
      *
      * @return void
      */
     public function test_Registers_Successfully()
    {
        $payload = [
            'name' => 'John',
            'email' => 'john@toptal.com',
            'password' => 'toptal123',
            'password_confirmation' => 'toptal123',
        ];

        $this->json('post', '/api/v1/register', $payload)
            ->assertStatus(201)
            ->assertJsonStructure([
                'name',
                'profile_photo_url',
                'email',
                'markets'
            ]);
        }
}

