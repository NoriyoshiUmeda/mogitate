<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function 商品一覧ページが正しく表示される()
    {
        Product::factory()->count(5)->create();

        $response = $this->get(route('products.index'));

        $response->assertStatus(200);
        $response->assertSee('商品一覧');
    }

    /** @test */
    public function 商品登録が成功する()
    {
        $response = $this->post(route('products.store'), [
            'name' => '新商品',
            'price' => 1500,
            'season' => [1, 2],
            'description' => 'テスト用の商品',
            'image' => null,
        ]);

        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseHas('products', ['name' => '新商品']);
    }

    /** @test */
    public function 商品編集画面が表示される()
    {
        $product = Product::factory()->create();

        $response = $this->get(route('products.edit', $product->id));

        $response->assertStatus(200);
        $response->assertSee($product->name);
    }
}