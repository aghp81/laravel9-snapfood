<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;

class CartTest extends TestCase
{
    use RefreshDatabase; // یعنی مایرگریشن ها رو پاک کرده و از نو ران میکند.
    /**
     * Test if user can see cart page.
     *
     * @return void
     */
    public function test_if_cart_pages_loads()
    {
        $response = $this->get('landing/cart');

        $response->assertStatus(200); // اگر استاتوس کد 200 بود یعنی صفحه با موفقیت لود شده.
    }

    /**
     * Test if user can add to cart.
     *
     * @return void
     */
    public function test_if_users_can_add_to_cart()
    {
        $user = User::factory()->create(); // ایجاد یک یوزر برای تست 
        $product = Product::factory()->create(); // ایجاد یک محصول برای تست 
        
        $response = $this->actingAs($user)->post("cart/manage/$product->id",[
            'type' => 'add'
        ]);

        $response->assertStatus(200); // اگر استاتوس کد 200 بود یعنی صفحه با موفقیت لود شده.
    }
}
