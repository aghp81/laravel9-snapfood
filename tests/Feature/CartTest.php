<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartTest extends TestCase
{
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
}
