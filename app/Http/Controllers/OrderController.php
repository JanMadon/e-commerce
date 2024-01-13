<?php

namespace App\Http\Controllers;

use App\Models\DetalsOrder;
use App\Models\Order;
use App\Models\Product;
use App\Services\OrderService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class OrderController extends Controller
{

    public function showMyOrders(Request $request, OrderService $orderService)
    {
        $userId = Auth::id();
        $orders = $orderService->getUserOrders($userId);

        $orderService->updateOrderStatus($userId, $request->payment);

        return Inertia::render('User/MyOrders', [
            'orders' => $orders,
            'payment' => $request->payment
        ]);
    }

    public function create(Request $request, OrderService $orderService)
    {
        $request->validate([
            'id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'min:1']
        ]);

        $userId = Auth::id();

        $order = $orderService->getUserActiveOrder($userId);
        if ($order) {
            $orderService->updateOrderQuantity($order, $request->id, $request->quantity);
        } else {
            $orderService->createOrder($userId, $request->id, $request->quantity);
        }
        return to_route('list.products');
    }

    public function cart(OrderService $orderService)
    {
        $userId = Auth::id();
        $order = $orderService->getUserActiveOrder($userId) ?? [];
        $dataDoCart = $orderService->getDataToCart($order);

        return Inertia::render('User/CartPage', [
            'order' => $dataDoCart
        ]);
    }

    public function removeDetalsOrderCart(Request $request, OrderService $orderService)
    {
        $order = $orderService->getUserActiveOrder(Auth::id());
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

    public function updateCart(Request $request, OrderService $orderService)
    {
        $userId = Auth::id();
        $order = $orderService->getUserActiveOrder($userId);

        if ($request->data) {
            $detal = $order->detalsOrder
                ->where('product_id', $request->data['product']['id'])->first();
            $detal->quantity = $request->data['quantity'];
            $detal->save();
        } elseif ($request->shipingMethod) {
            $order->shiping_method = $request->shipingMethod;
            $order->save();
        }
    }

    public function payOrder(Request $request)
    {
        //validuj
        $order = Order::find($request->data['id']);
        $url =  $this->payByStripe($order);

        return response()->json([
            'paymentPage' => $url,
        ]);
    }

    private function payByStripe($order)
    {
        try {
            Stripe::setApiKey(config('stripe.sk'));
            $paySession = Session::create([
                'line_items' => [
                    [
                        'price_data' => [
                            'currency'     => 'PLN',
                            'product_data' => [
                                'name' => implode(', ', $order->productsNameAndQuantity()),
                            ],
                            'unit_amount'  => ($order->amount() * 100),
                        ],
                        'quantity'   => 1,
                    ],
                ],
                'mode'        => 'payment',
                'success_url' => route('my.order', ['payment' => 'accepted']),
                'cancel_url'  => route('my.order.post', ['payment' => 'rejected']),
            ]);

            return $paySession->url;
        } catch (Exception $e) {
            return $e;
            dd('error');
        }
    }
}
