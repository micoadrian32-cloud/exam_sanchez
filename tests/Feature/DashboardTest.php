<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_the_login_page()
    {
        $response = $this->get(route('dashboard'));
        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_users_can_visit_the_dashboard()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('dashboard'));
        $response->assertOk();
    }

    public function test_authenticated_users_can_create_a_product_with_phone_and_address(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('product.store'), [
            'name' => 'Sample product',
            'price' => '12.50',
            'description' => 'Sample description',
            'phone' => '555-0100',
            'address' => '123 Main Street',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseHas('products', [
            'name' => 'Sample product',
            'phone' => '555-0100',
            'address' => '123 Main Street',
        ]);
    }
}
