<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function 商品名が正しく設定される()
    {
        $product = Product::factory()->create(['name' => 'テスト商品']);

        $this->assertEquals('テスト商品', $product->name);
    }
}
