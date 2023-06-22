<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Shop\Customer;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class test_can_view_list_of_customers extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use DatabaseMigrations;

    public function test_user_can_list_all_customers()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Customer::factory()->count(5)->create();

        $response = $this->get('/api/v1/customers');
        $response->assertStatus(206);
        $response->assertJsonCount(5, 'data');
    }

    public function test_user_can_create_a_customer()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/api/v1/customers', [
            'name' => 'example',
            'email' => 'example@example.com',
            'gender' => 'male',
            'birthday' => '2020-01-01'
        ]);

        $response->assertStatus(201);
    }

    public function test_user_can_update_a_customer()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/api/v1/customers', [
            'name' => 'example',
            'email' => 'example@example.com',
            'gender' => 'male',
            'birthday' => '2020-01-01'
        ]);

        $id = $response->json('id');

        $response = $this->put('/api/v1/customers/' . $id, [
            'name' => 'example updated',
            'email' => 'exampleupdated@example.com',
        ]);

        $response->assertStatus(200)->assertJson(['name' => 'example updated']);
    }

    public function test_user_can_delete_a_customer()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/api/v1/customers', [
            'name' => 'example',
            'email' => 'example@example.com',
            'gender' => 'male',
            'birthday' => '2020-01-01'
        ]);

        $id = $response->json('id');

        $response = $this->delete('/api/v1/customers/' . $id);

        $response->assertStatus(204);
    }
}
