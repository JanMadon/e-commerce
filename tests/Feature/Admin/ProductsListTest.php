<?php

namespace Tests\Feature\Admin;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class ProductsListTest extends TestCase
{
    public function test_product_list_page_without_query_string(): void
    {
        $user = User::factory()->make(['level'=>'admin']);
        $this->actingAs($user);
        $this->assertAuthenticated();

        Product::factory()->create(['name' => 'iPhone 12']);

        $response = $this->get(route('products'));

        $response->assertStatus(200);
        $response->assertSee('iPhone 12');
    }

    public function test_product_list_page_with_query_string(): void
    {
        $user = User::factory()->make(['level'=>'admin']);
        $this->actingAs($user);
        $this->assertAuthenticated();

        
        //Product::factory()->count(2)->create();
        Product::truncate();
        $response = $this->get(route('products', ['perPage' => 22])); 

        $response->assertStatus(200);
        $expectedPerPage = 19;
        $response->assertInertia(fn(Assert $page) => $page
            ->component('Admin/ProductsList')
            ->has('products', fn(Assert $prdoucts) => 
                
             $prdoucts->where('per_page', 22)
            )
        );
        
    }
}
