<?php

namespace Tests\Feature\Api;

use Tests\TestCase;

class DrugTypeTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->getJson('/api/user/drug-types');

        $response->assertJsonStructure([
            '*' => ['id', 'name', 'unit'],
        ]);

        $response->assertStatus(200);
    }
}
