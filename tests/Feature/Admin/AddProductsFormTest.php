<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class AddProductsFormTest extends TestCase
{

    public function test_add_product_page_can_be_rendered():  void
    {
        $user = User::factory()->make(['level'=>'admin']);
        $this->actingAs($user);
        $this->assertAuthenticated();

        $response = $this->get(route('product.create')); 
        $response->assertStatus(200);

    }

    public function test_save_product_in_store():  void
    {
        $user = User::factory()->make(['level'=>'admin']);
        $this->actingAs($user);
        $this->assertAuthenticated();

        Category::truncate();
        SubCategory::truncate();

        Category::factory()->create();
        SubCategory::factory()->create();

        $data = [
            'name'=>'testProduct',
            'category_id'=> 1,
            'subcategory_id'=> 1,
            'quantity'=> 10,
            'price'=> 500,
            'description'=> 'test description',
        ];

        $response = $this->post(route('product.store'), $data); 
        $response->assertStatus(302);

    }

}
