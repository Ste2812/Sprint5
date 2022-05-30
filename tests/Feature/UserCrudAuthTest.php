<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class UserCrudAuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_login()
    {
        $response = $this->post('/api/login', [
            'name' => '',
            'email' => '',
            'password' => '',
        ]);
        $response->assertStatus(200);

    }

    public function test_register()
    {
        $response = $this->post('/api/register', [
            'name' => '',
            'email' => '',
            'password' => '',
        ]);
        $response->assertStatus(200);

    }

    public function test_logout()
    {
        $response = $this->post('/api/logout', [
            'name' => '',
            'email' => '',
            'password' => '',
        ]);
        $response->assertStatus(200);
    }
}
