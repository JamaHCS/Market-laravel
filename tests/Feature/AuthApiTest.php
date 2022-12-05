<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;


class AuthApiTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_Requires_Email_And_Login()
    {
        $this->json('POST', 'api/v1/login')
            ->assertStatus(422);
    }

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

