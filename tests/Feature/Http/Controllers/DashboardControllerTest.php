<?php

namespace agoalofalife\Tests\Feature\Http\Controllers;

use agoalofalife\postman\Models\ModePostEmail;
use agoalofalife\postman\Models\SheduleEmail;
use agoalofalife\Tests\TestCase;
use agoalofalife\postman\Models\User;

class DashboardControllerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testIndex() : void
    {
        factory(SheduleEmail::class, 5)->create();
        $this->get('/postman/api/dashboard.table.tasks')->assertJsonStructure([
            [
                'id',
                'date',
                'email_id',
                'mode_id',
                'status_action',
                'email' => [
                    'id',
                    'theme',
                    'text',
                    'users'
                ],
                'mode' => [
                    'id',
                    'name',
                    'description'
                ],
            ]
        ])->assertStatus(200);
    }

    public function testListMode() : void
    {
        factory(ModePostEmail::class, 1)->create();
        $this->get('/postman/api/dashboard.table.listMode')->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'description',
                'created_at',
                'updated_at',
                'deleted_at',
            ]
        ])->assertStatus(200);
    }

    public function testUsers() : void
    {
        factory(User::class, 5)->create();
        $this->get('/postman/api/dashboard.table.users')->assertJsonStructure([
            '*' => [
             'id',
             'name',
             'email',
             'password',
             'remember_token',
             'created_at',
             'updated_at',
            ]
        ])->assertStatus(200);
    }

    public function testTableColumn() : void
    {
        $this->get('/postman/api/dashboard.table.column')->assertJsonStructure([
            'columns' => [
                '*' => [
                    'prop',
                    'size',
                    'label'
                ],
            ]
        ])->assertJsonStructure([
            'button' => [
                'edit',
                'remove'
            ]
        ])->assertStatus(200);
    }

    public function testFormColumn() : void
    {
        $this->get('/postman/api/dashboard.table.formColumn')->assertJsonStructure([
            'date' => [
                'label',
                'rule' => [
                    'required',
                    'message',
                    'trigger',
                ],
            ],
            'theme' => [
                    'label'
                ],
                'text' => [
                    'label'
                ],
                'type' => [
                    'label',
                    'placeholder'
                ],
                'users' => [
                    'label',
                    'placeholder'
                ],
                'button' => [
                    'success',
                    'cancel'
                ],
                'popup' => [
                    'question',
                    'title',
                    'confirmButtonText',
                    'cancelButtonText',
                    'success.message',
                    'info.message'
                ]
        ]);
    }

    public function testCreateTask() : void
    {

        $users = factory(User::class, 3)->create()->map(function ($value) {return $value->id;});
        $this->artisan('postman:seed');
//        $this->seed('ModePostEmailSeeder');
        $this->post('/postman/api/dashboard.table.tasks.create',[
            'theme' => $this->faker()->word,
            'text' => $this->faker()->text,
            'users' => $users,
            'date' => $this->faker()->date('Y-m-d H:i:s'),
            'mode' => ModePostEmail::all()->random(),
        ]) ->assertJson([
            'status' => true,
        ]);;
    }
}