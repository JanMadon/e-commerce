<?php

namespace Tests\Feature\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class RouteAccessibilityTest extends TestCase
{
    public function test_admin_redirection_after_loggingin(): void
    {
        $user = User::factory()->make(['level'=>'admin']);
        $this->actingAs($user);
        $this->assertAuthenticated();

        $response = $this->get(RouteServiceProvider::HOME);
        $response->assertRedirect(route('dashboard'));
        $this->get(route('dashboard'))->assertStatus(200);
    }

    public function test_orders_page_can_be_rendered(): void
    {
        $user = User::factory()->make(['level'=>'admin']);
        $this->actingAs($user);
        $this->assertAuthenticated();

        Order::factory()->create(['payment'=>'accepted', 'amount_paid' => 999]);

        $response = $this->get(route('orders')); 
        $response->assertStatus(200);
    
        $response->assertSee('accepted');
        $response->assertSee(999);
    }

    public function test_users_list_page_can_be_rendered(): void
    {
        $user = User::factory()->make(['level'=>'admin']);
        $this->actingAs($user);
        $this->assertAuthenticated();

        User::factory()->create(['firstname'=>'Jan', 'lastname' => 'Kowalski']);

        $response = $this->get(route('admin.usersList')); 
        $response->assertStatus(200);
    
        $response->assertSee('Jan');
        $response->assertSee('Kowalski');

    }

    public function test_raports_page_can_be_rendered(): void
    {
        $user = User::factory()->make(['level'=>'admin']);
        $this->actingAs($user);
        $this->assertAuthenticated();

         User::factory()->create();
        Order::factory()->create();

        $response = $this->get(route('admin.raports'));

        $response->assertStatus(200);
    
        

    }

}
