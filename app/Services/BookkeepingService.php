<?php

namespace App\Services;

use App\Models\DetalsOrder;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

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
