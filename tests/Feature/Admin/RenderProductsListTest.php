<?php

namespace Tests\Feature\Admin;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class RenderProductsListTest extends TestCase
{
    public function test_product_list_page_without_query_string(): void
    {
        $user = User::factory()->make(['level'=>'admin']);
        $this->actingAs($user);
        $this->assertAuthenticated();

        Product::factory()->create(['name' => 'iPhone 12', 'price'=>2999]);

        $response = $this->get(route('products'));

        $response->assertStatus(200);
        $response->assertSee('iPhone 12');
    }

    public function test_product_list_page_with_per_page_query_string(): void
    {
        $user = User::factory()->make(['level'=>'admin']);
        $this->actingAs($user);
        $this->assertAuthenticated();

        Product::factory()->count(20)->create();
        $expectedPerPage = 19;
       
        $response = $this->get(route('products', ['perPage' => $expectedPerPage])); 
        $response->assertStatus(200);
        $response->assertInertia(function(Assert $page) {
                $page->component('Admin/ProductsList');
                $page->has('products', function(Assert $prdoucts) { 
                    $prdoucts->where('per_page', 19)->etc();
                });
            }
        );  
    }

    public function test_product_list_page_with_search_query_string(): void
    {
        $user = User::factory()->make(['level'=>'admin']);
        $this->actingAs($user);
        $this->assertAuthenticated();
        
        $name = 'samsung 23';
        Product::factory()->create(['name'=> $name]);
       
        $response = $this->get(route('products', ['search' => $name])); 
        $response->assertStatus(200);
        $response->assertInertia(function(Assert $page) use ($name) {
                $page->component('Admin/ProductsList');
                $page->has('products', function(Assert $prdoucts) use ($name) { 
                    $prdoucts->has('data.0', function(Assert $data) use ($name) { 
                        $data->where('name', $name)->etc();
                    })->etc();
                });
            }
        ); 
    }
}
