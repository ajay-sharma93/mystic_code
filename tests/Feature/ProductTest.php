<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ProductTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_product_list_is_working(): void
    {

        $this->mockProductData();

        $response = $this->get('/product/index');

        $response->assertViewHas('products');

        $response->assertSeeText('Test Product');

        $response->assertStatus(200);
    }

    public function test_product_edit_page_shows_product_values(): void
    {

        $this->mockProductData();

        $response = $this->get('/product/edit/1');

        $response->assertViewHas('product');

        $response->assertSee('input', 'value="Test Product"');

        $response->assertSeeText('Test Description');

        $response->assertStatus(200);
    }

    private function mockProductData()
    {
        DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => 'Men',
            ]
        ]);
        DB::table('products')->insert([
            [
                'id' => 1,
                'name' => 'Test Product',
                'price' => 100,
                'description' => 'Test Description',
                'stock_level' => 5,
                'category_id' => 1,
            ]
        ]);
    }
}
