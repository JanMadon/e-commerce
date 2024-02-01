<?php

namespace Tests\Feature;

use App\Models\DetalsOrder;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class CartTest extends TestCase
{
    
    public function test_add_product_to_card(): void
    {
        $user = User::factory()->make(['level'=>'user']);
        $this->actingAs($user);
        $this->assertAuthenticated();

        $product = Product::factory()->create();
    
        $data = [
            'productId' => $product->id,
            'quantity' => fake()->randomNumber(1),
        ];

        $response = $this->post(route('addToCart'), $data); 
        $response->assertStatus(302);
    }

    public function test_orders_page_can_be_rendered(): void
    {
        $user = User::factory()->create(['level'=>'user']);
        $this->actingAs($user);
        $this->assertAuthenticated();

        $order = Order::factory()->create(['payment'=>'active', 'user_id' => $user->id]);
        DetalsOrder::factory()->count(2)->create(['order_id' => $order->id]);

        $response = $this->get(route('cart')); 
        $response->assertStatus(200);
        $response->assertInertia(function(Assert $page){
            $page->component('User/CartPage');
            $page->has('order', function(Assert $order){
                $order->has('detals_order', 2)->etc();
            });
        });
    }

    public function test_product_remove_from_cart(): void
    {
        $user = User::factory()->create(['level'=>'user']);
        $this->actingAs($user);
        $this->assertAuthenticated();

        $order = Order::factory()->create(['payment'=>'active', 'user_id' => $user->id]);
        $orderDetal = DetalsOrder::factory()->create(['order_id' => $order->id]);

        $data = [
            'detalId'=> $orderDetal->id,
        ];

        $response = $this->delete(route('cart.deleteProduct', $data)); 
        $response->assertStatus(200);
        $response->assertJson(['detalId' => $orderDetal->id, 'countDetal' => 1]);
    }

    public function test_pay_order(): void
    {
        $user = User::factory()->create(['level'=>'user']);
        $this->actingAs($user);
        $this->assertAuthenticated();

        $order = Order::factory()->create(['payment'=>'active', 'user_id' => $user->id]);
        $orderDetal = DetalsOrder::factory()->create(['order_id' => $order->id]);

        $data = [
            'orderId'=> $order->id,
        ];

        $response = $this->post(route('cart.payOrder', $data)); 
        $response->assertStatus(200);
        $response->assertJson(function(AssertableJson $json){
            $json->has('paymentPage');
        });
    }

    










    


}
