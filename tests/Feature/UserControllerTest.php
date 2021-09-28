<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class UserControllerTest extends TestCase
{

    public function testUserIsCreatedSuccessfully()
    {
        $payload = [
            'name' => 'joao',
            'email' => 'joaopauloln'.rand(1,1000).'@gmail.com',
            'birthday' => '1984-05-05',
            'gender' => 'man',
        ];

        $this->json('post', 'api/user', $payload)
            ->assertStatus(201)
            ->assertJsonStructure(
                [
                    'data' => [
                        'id',
                        'name',
                        'email',
                        'birthday',
                        'gender'
                    ]
                ]
            );

        $this->assertDatabaseHas('users', $payload);
    }

    public function testUserIsUpdatedSuccessfully()
    {
        $payload = [
            'name' => 'joao',
            'email' => 'jp'.rand(1,1000).'@gmail.com',
            'birthday' => '1984-05-05',
            'gender' => 'man',
        ];

        $json = $this->json('post', 'api/user', $payload)
            ->assertStatus(201)
            ->assertJsonStructure(
                [
                    'data' => [
                        'id',
                        'name',
                        'email',
                        'birthday',
                        'gender'
                    ]
                ]
            );

        $data = json_decode($json->decodeResponseJson()->json)->data;

        $payload = [
            'name' => 'joao changed',
            'email' => 'jpchanged'.rand(1,1000).'@gmail.com',
            'birthday' => '1984-05-05',
            'gender' => 'man',
        ];

        $this->json('put', 'api/user/'.$data->id, $payload)
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'data' => [
                        'id',
                        'name',
                        'email',
                        'birthday',
                        'gender'
                    ]
                ]
            );

        $this->assertDatabaseHas('users', $payload);
    }

    public function testUserIsDeletedSuccessfully()
    {
        $payload = [
            'name' => 'joao',
            'email' => 'jp'.rand(1,1000).'@gmail.com',
            'birthday' => '1984-05-05',
            'gender' => 'man',
        ];

        $json = $this->json('post', 'api/user', $payload)
            ->assertStatus(201)
            ->assertJsonStructure(
                [
                    'data' => [
                        'id',
                        'name',
                        'email',
                        'birthday',
                        'gender'
                    ]
                ]
            );

        $data = json_decode($json->decodeResponseJson()->json)->data;

        $this->json('delete', 'api/user/'.$data->id)
            ->assertStatus(204);
    }

    public function testUserGetAllUsers()
    {

       $json = $this->json('get', 'api/users')
            ->assertStatus(200);

       $data = json_decode($json->decodeResponseJson()->json)->data;

       $this->assertIsArray($data);
    }

    public function testUserGetOne()
    {
        $payload = [
            'name' => 'joao',
            'email' => 'jp'.rand(1,1000).'@gmail.com',
            'birthday' => '1984-05-05',
            'gender' => 'man',
        ];

        $json = $this->json('post', 'api/user', $payload)
            ->assertStatus(201)
            ->assertJsonStructure(
                [
                    'data' => [
                        'id',
                        'name',
                        'email',
                        'birthday',
                        'gender'
                    ]
                ]
            );

        $data = json_decode($json->decodeResponseJson()->json)->data;

        $json = $this->json('get', 'api/user/'.$data->id)
            ->assertStatus(200);

        $data = json_decode($json->decodeResponseJson()->json)->data;

        $this->assertEquals($data->name, $payload['name']);
    }
}
