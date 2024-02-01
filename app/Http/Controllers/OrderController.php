<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Requests\PayRequest;
use App\Models\Order;
use App\Services\OrderServiceInterface;
use App\Services\PayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class OrderController extends Controller
{
    private OrderServiceInterface $orderService;
    private PayService $payService;

    public function __construct(OrderServiceInterface $orderService, PayService $payService)
    {
        $this->orderService = $orderService;
        $this->payService = $payService;
    }

    public function showMyOrders(Request $request)
    {
        $userId = Auth::id();
        $orders = $this->orderService->getUserOrders($userId);

        $this->orderService->updateOrderPayment($userId, $request->payment);

        return Inertia::render('User/MyOrders', [
            'orders' => $orders,
            'payment' => $request->payment
        ]);
    }

    public function create(OrderRequest $request)
    {
        $request->validated();

        $userId = Auth::id();

        $order = $this->orderService->getUserActiveOrder($userId);
        if ($order) {
            $this->orderService->updateOrderQuantity($order, $request->productId, $request->quantity);
        } else {
            $this->orderService->createOrder($userId, $request->productId, $request->quantity);
        }
        return redirect()->back();
    }

    public function cart()
    {
        $userId = Auth::id();
        $order = $this->orderService->getUserActiveOrder($userId) ?? [];
        $dataDoCart = $this->orderService->getDataToCart($order);

        return Inertia::render('User/CartPage', [
            'order' => $dataDoCart
        ]);
    }

    public function removeDetalsOrderCart(Request $request)
    {
        $order = $this->orderService->getUserActiveOrder(Auth::id());
        $detalsOrder = $order->detalsOrder->where('id', $request->detalId)->first();
        $detalsOrder->delete();

        if (count($order->detalsOrder) === 1) {
            $order->delete();
        }

        return response()->json([
            'detalId' => $request->detalId,
            'countDetal' => count($order->detalsOrder)
        ]);
    }

    public function updateCart(OrderRequest $request)
    {
        $request->validated();
        $userId = Auth::id();
        $order = $this->orderService->getUserActiveOrder($userId);

        if ($request->productId) {
            $detal = $order->detalsOrder
                ->where('product_id', $request->productId)->first();
            $detal->quantity = $request->quantity;
            $detal->save();
        } elseif ($request->shipingMethod) {
            $order->shiping_method = $request->shipingMethod;
            $order->save();
        }
    }

    public function setShipmentMethod(Request $request)
    {
        $userId = Auth::id();
        $order = $this->orderService->getUserActiveOrder($userId);

        $order->shiping_method = $request->shipingMethod;
        $order->save();
    }

    public function payOrder(PayRequest $request)
    {
        $request->validated();
        
        $order = Order::find($request->orderId);
        $url =  $this->payService->payByStripe($order);
        return response()->json([
            'paymentPage' => $url,
        ]);
    }
}
