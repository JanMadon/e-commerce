<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Inertia\Testing\AssertableInertia as Assert;


class CategoriesAndSubcategoriesTest extends TestCase
{

    public function test_categories_page_can_be_rendered(): void
    {
        $user = User::factory()->make(['level'=>'admin']);
        $this->actingAs($user);
        $this->assertAuthenticated();

        Category::truncate();
        SubCategory::truncate();

        Category::factory()->create(['id' => 1]);
        Category::factory()->create(['id' => 2]);
        SubCategory::factory()->count(2)->create(['category_id' => 1]);
        SubCategory::factory()->count(3)->create(['category_id' => 2]);


        $response = $this->get(route('categories.index')); 
        $response->assertStatus(200);
        $response->assertInertia(function (Assert $page){
            $page->component('Admin/Categories');
            $page->has('categories',2, function(Assert $categories){
                $categories->has('sub_category', 2)->etc();
            })->etc();
        } );

    }

    public function test_create_category(): void
    {
        $user = User::factory()->make(['level'=>'admin']);
        $this->actingAs($user);
        $this->assertAuthenticated();

        Category::truncate();
        SubCategory::truncate();

        $data = [
            'parentId'=> null,
            'type'=> 'category',
            'name'=> 'TestCategory',
            'description'=> 'DescriptionTestCategory',
        ];

        $response = $this->post(route('categories.create'), $data); 
        $response->assertStatus(302);
    }

    public function test_create_subcategory(): void
    {
        $user = User::factory()->make(['level'=>'admin']);
        $this->actingAs($user);
        $this->assertAuthenticated();

        Category::truncate();
        SubCategory::truncate();

        Category::factory()->create();

        $data = [
            'parentId'=> Category::inRandomOrder()->first()->id,
            'type'=> 'subcategory',
            'name'=> 'TestSubcategory',
            'description'=> 'DescriptionTestSubcategory',
        ];

        $response = $this->post(route('categories.create'), $data); 
        $response->assertStatus(302);
    }

    
    public function test_edit_category(): void
    {
        $user = User::factory()->make(['level'=>'admin']);
        $this->actingAs($user);
        $this->assertAuthenticated();

        Category::truncate();
        SubCategory::truncate();

        Category::factory()->create();
        $categoryId = Category::inRandomOrder()->first()->id;

        $data = [
            'type'=> 'category',
            'name'=> 'EditTestCategory',
            'id' =>  $categoryId,
            'description'=> 'EditDescriptionTestCategory',
        ];

        $response = $this->put(route('categories.edit', $categoryId), $data); 
        $response->assertStatus(302);
    }

    public function test_edit_subcategory(): void
    {
        $user = User::factory()->make(['level'=>'admin']);
        $this->actingAs($user);
        $this->assertAuthenticated();

        Category::truncate();
        SubCategory::truncate();

        $category = Category::factory()->create();
        $categoryId = $category->id;
        $subcategory = SubCategory::factory()->create(['category_id'=> $categoryId]); 
        $subcategoryId = $subcategory->id;

        $data = [
            'type'=> 'subcategory',
            'name'=> 'EditNameTestSubcategory',
            'id' => $subcategoryId,
            'description'=> 'EditDescriptionTestSubcategory',
        ];

        $response = $this->put(route('categories.edit', $categoryId), $data);
        $response->assertStatus(302);
    }
    public function test_delete_category(): void
    {
        $user = User::factory()->make(['level'=>'admin']);
        $this->actingAs($user);
        $this->assertAuthenticated();

        Category::truncate();
        SubCategory::truncate();

        Category::factory()->create();
        $categoryId = Category::inRandomOrder()->first()->id;

        $data = [
            'parentId'=> null,
            'id'=> $categoryId,
        ];

        $response = $this->delete(route('categories.delete', $data)); 
        $response->assertStatus(302);
    }

    public function test_delete_subcategory(): void
    {
        $user = User::factory()->make(['level'=>'admin']);
        $this->actingAs($user);
        $this->assertAuthenticated();

        Category::truncate();
        SubCategory::truncate();

        $category = Category::factory()->create();
        $categoryId = $category->id;
        $subcategory = SubCategory::factory()->create(['category_id'=> $categoryId]); 
        $subcategoryId = $subcategory->id;
        
        $data = [
            'parentId'=> $subcategory,
            'id'=> $subcategoryId,
        ];

        $response = $this->delete(route('categories.delete', $data)); 
        $response->assertStatus(302);
    }
}
