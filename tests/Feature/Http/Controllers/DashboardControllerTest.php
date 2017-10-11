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
            '*' => []
        ])->assertStatus(200);

    }
}