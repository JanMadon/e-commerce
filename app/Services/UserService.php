<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use Exception;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class UserService {

    public function getUserWithInfo(int $id)
    {
        $user = User::with('address')->find($id);
        $user->lastOrder = Order::userLastOrder($id);
        $user->numOfOrder = Order::userNumOfOrders($id);
        return $user;
    }

    public function getAllUsers($search, $perPage = 15)
    {
        $query = User::with('address')
        ->orderBy('created_at', 'desc');
        
        if($search){
            $query->where('name', 'like', "$search%")
            ->orWhere('email', 'like', "%$search%");
        }
        $query = $query->paginate($perPage);

        return $query;
    }

    public function updateField(int $userId, string $field, string $newValue)
    {
        User::find($userId)->update([$field => $newValue]);

    }
}