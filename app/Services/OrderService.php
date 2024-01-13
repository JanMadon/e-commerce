<?php

namespace App\Services;

use App\Models\DetalsOrder;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class OrderService
{
    public function getUserOrders($userId)
    {
        return Order::with('detalsOrder.product')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getUserActiveOrder($userId)
    {
        return $this->getUserOrders($userId)->where('status', 'active')->first();
    }

    public function updateOrderStatus($userId, $paymetStatus)
    {
        $order = $this->getUserActiveOrder($userId);

        if ($order) {
            if ($paymetStatus === 'accepted') {
                $order->status = 'accepted';
                $order->payd_at = Carbon::today()->format('Y-m-d');
                $order->amount_paid = $order->amount();
            }
            if ($paymetStatus === 'rejected') {
                $order->status = 'rejected';
                $order->payd_at = Carbon::today()->format('Y-m-d');
            }
            $order->save();
        }
    }

    public function createOrder($userId, $productId, $quantity = 1)
    {
        $order = new Order([
            'user_id' => $userId,
            'status' => 'active',
        ]);
        $order->save();

        $this->createDetalsOrder($order->id, $productId, $quantity);

        return $order;
    }
    
    public function createDetalsOrder($orderId, $productId, $quantity = 1)
    {
        $detalsOrder = new DetalsOrder([
            'order_id' => $orderId,
            'product_id' => $productId,
            'quantity' => $quantity,
        ]);
        $detalsOrder->save();
        return $detalsOrder;
    }

    public function updateOrderQuantity($order, $productId, $quantity)
    {
        $detalsOrder = $order->detalsOrder->where('product_id', $productId)->first();
        if ($detalsOrder) {
            $detalsOrder->quantity += $quantity;
            $detalsOrder->save();
        } else {
            $detalsOrder = new DetalsOrder([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
            $detalsOrder->save();
        }
    }

    public function getDataToCart($order)
    {
        if ($order) {
            foreach ($order->detalsOrder as $detail) {
                $product = $detail->product;
                $photosNames = Storage::files("product/$product->id");
                $photoName = basename($photosNames[0]);
                $photo = Storage::get("product/$product->id/$photoName");
                $photo = base64_encode($photo);
                $product->photo = $photo;
            }
        }
        return $order;
    }
}
