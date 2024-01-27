<?php

namespace App\Services;

interface OrderServiceInterface
{
    public function getAllOredrs($search, $perPage = 15);
    public function getUserOrders($userId);
    public function getLatestOrders( int $limit = 0, bool $forHuman = false);
    public function getUserActiveOrder($userId);
    public function updateOrderPayment($userId, $paymetStatus);
    public function createOrder($userId, $productId, $quantity = 1);
    public function createDetalsOrder($orderId, $productId, $quantity = 1);
    public function updateOrderQuantity($order, $productId, $quantity);
    public function updateField(int $userId, string $field, string $newValue);
    public function getDataToCart($order);
}
