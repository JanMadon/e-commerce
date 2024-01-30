<?php

namespace App\Services;

use App\Models\DetalsOrder;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class OrderService implements OrderServiceInterface
{
    public function getAllOredrs($search, $perPage = 15)
    {
        $query = Order::with('user')
        ->with('detalsOrder.product')
        ->orderBy('created_at', 'desc');
        
        if($search){
            $query->whereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', "$search%");
            });
    
        }
        $query = $query->paginate($perPage);
     
        return $query;
    }

    public function getUserOrders($userId)
    {
        return Order::with('detalsOrder.product')
            ->with('user')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate();
    }

    public function getLatestOrders( int $limit = 0, bool $forHuman = false)
    {
        $latestOrders = Order::with('user')
            ->with('detalsOrder')
            ->where('payment', 'accepted')
            ->orderBy('payd_at', 'desc');

        if($limit){
            $latestOrders->limit($limit);
        }
        $latestOrders = $latestOrders->get();            

        if($forHuman) {
            foreach($latestOrders as $order){
                $time = Carbon::parse($order->payd_at)->diffForHumans();
                $order->latest = $time; 
            }
        }
        
        return $latestOrders;
    }

    public function getUserActiveOrder($userId)
    {
        return $this->getUserOrders($userId)->where('payment', 'active')->first();
    }

    public function updateOrderPayment($userId, $paymetStatus)
    {
        $order = $this->getUserActiveOrder($userId);

        if ($order) {
            if ($paymetStatus === 'accepted') {
                $order->payment = 'accepted';
                $order->status = 'waiting';
                $order->payd_at = Carbon::today()->format('Y-m-d');
                $order->amount_paid = $order->amount();
            }
            if ($paymetStatus === 'rejected') {
                $order->payment = 'rejected';
                $order->payd_at = Carbon::today()->format('Y-m-d');
            }
            $order->save();
        }
    }

    public function createOrder($userId, $productId, $quantity = 1)
    {
        $order = new Order([
            'user_id' => $userId,
            'payment' => 'active',
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

    public function updateField(int $userId, string $field, string $newValue)
    {
        Order::find($userId)->update([$field => $newValue]);
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
