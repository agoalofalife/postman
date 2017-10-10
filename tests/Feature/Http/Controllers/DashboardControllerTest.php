<?php

namespace agoalofalife\Tests\Feature\Http\Controllers;

use agoalofalife\postman\Models\SheduleEmail;
use agoalofalife\Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    public function testIndex() : void
    {
        factory(SheduleEmail::class, 5)->create();
        $response = $this->get('/postman/api/dashboard.table.tasks');
        $response->assertJsonStructure([
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
        ]);
        $response->status(200);
    }
}