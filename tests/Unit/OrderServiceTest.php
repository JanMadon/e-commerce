<?php

namespace Tests\Unit;

use App\Services\OrderService;
use PHPUnit\Framework\TestCase;

class OrderServiceTest extends TestCase
{
    //use ;

    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function testGetAllOrdersWithSearch()
    {
        // Arrange
        $orderService = new OrderService();
        $perPage = 15;
        $searchTerm = 'example';

        // Act
        $result = $orderService->getAllOredrs($searchTerm, $perPage);

        // Assert
        $this->assertInstanceOf(\Illuminate\Pagination\LengthAwarePaginator::class, $result);
        // Dodaj więcej asercji w zależności od tego, co chcesz sprawdzić
    }
}
