<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Product;
class ProductTest extends TestCase
{
	protected $product;

    public function setUp(): void
    {
    	$this->product  = new Product('test_product',200);
    }

    /** @test */
    public function AProductHasName()
    {
        $this->assertEquals('test_product',$this->product->getName());
    }

    public function testAProductHasPrice()
    {
        $this->assertEquals(200,$this->product->getPrice());
    }
}
