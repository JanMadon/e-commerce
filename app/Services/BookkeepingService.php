<?php

namespace App\Services;

use App\Models\Order;

class BookkeepingService
{
    public function getTotalIncome(): int
    {
        $totalIncome = 0;
        $paidOrders = Order::where('payment', 'accepted')
            ->get();
        foreach($paidOrders as $order) {
            $totalIncome += $order->amount_paid;
        } 
        return $totalIncome;
    }
}
