<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Order;
use App\Product;

class OrderTest extends TestCase
{
    public function testOrderConsistOfProducts()
    {
    	$order = $this->createOrderWithProducts();

    	$this->assertCount(2, $order->products());
    }

     public function testOrderTotalPrice()
    {
    	$order = $this->createOrderWithProducts();

    	$this->assertEquals(150+250, $order->total());
    }

    protected function createOrderWithProducts()
    {
    	$order = new Order;

    	$p1 = new Product('p1',150);
    	$p2 = new Product('p2',250);

    	$order->add($p1);
    	$order->add($p2);

    	return $order;
    }
}
