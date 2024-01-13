<?php

namespace App\Http\Controllers;

use App\Models\DetalsOrder;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Component\String\UnicodeString;

class OrderController extends Controller
{

    public function showMyOrders(Request $request)
    {
        $orders = Order::with('detalsOrder')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        if( $orders->where('status', 'active')->first()){
            if($request->payment === 'accepted') {
                $order = $orders->where('status', 'active')->first();
                $order->status = 'accepted';
                $order->payd_at = Carbon::today()->format('Y-m-d');
                $order->amount_paid = $order->amount();
                $order->save();
            }

            if($request->payment === 'rejected') {
                $order = $orders->where('status', 'active')->first();
                $order->status = 'rejected';
                $order->payd_at = Carbon::today()->format('Y-m-d');
                $order->save();
            }
        }

        foreach ($orders as $order) {
            foreach ($order->detalsOrder as $detal) {
                $detal->product;
                // dump($detal); 
            }
        }

        return Inertia::render('User/MyOrders', [
            'orders' => $orders,
            'payment' => $request->payment
        ]);
    }

    public function cart()
    {
        $order = Order::where('user_id', Auth::user()->id)
            ->where('status', 'active')
            ->first();

        if (!$order) {
            return Inertia::render('User/CartPage', [
                'products' => [],
                'order' => [$order]
            ]);
        };

        $details = DetalsOrder::where('order_id', $order->id)->get();

        $products = [];
        foreach ($details as $detail) {
            $product = Product::find($detail->product_id);
            $product->quantity = $detail->quantity;
            $products[] = $product;
        }

        //* Photos:
        $photos = [];
        foreach ($products as $product) {
            $photosNames = Storage::files("product/$product->id");
            $photoName = basename($photosNames[0]);
            $photo = Storage::get("product/$product->id/$photoName");
            $photo = base64_encode($photo);
            $product->photo = $photo;
        }
        return Inertia::render('User/CartPage', [
            'products' => $products,
            'order' => $order
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'min:1']
        ]);

        try {
            if (!Order::where('user_id', Auth::user()->id)->where('status', 'active')->exists()) {
                // dd('asd');
                $order = new Order([
                    'user_id' => Auth::user()->id,
                    'status' => 'active',
                ]);
                $order->save();

                // TODO dodaj do storzonego zamowneia produkt 
                if (DetalsOrder::where('product_id', $request->id)->where('order_id', $order->id)->exists()) {
                    $detalsOrder = DetalsOrder::where('product_id', $request->id)->first();
                    $detalsOrder->quantity++;
                    $detalsOrder->save();
                } else {
                    $detalsOrder = new DetalsOrder([
                        'order_id' => $order->id,
                        'product_id' => $request->id,
                        'quantity' => $request->quantity,
                    ]);
                    $detalsOrder->save();
                } // hamsko przeklejone jest

            } else {
                $order = Order::where('user_id', Auth::user()->id)
                    ->where('status', 'active')
                    ->first();

                // sprawdz czy istnieje już dodany produkt
                if (DetalsOrder::where('product_id', $request->id)->where('order_id', $order->id)->exists()) {
                    $detalsOrder = DetalsOrder::where('product_id', $request->id)->first();
                    $detalsOrder->quantity++;
                    $detalsOrder->save();
                } else {
                    $detalsOrder = new DetalsOrder([
                        'order_id' => $order->id,
                        'product_id' => $request->id,
                        'quantity' => $request->quantity,
                    ]);
                    $detalsOrder->save();
                }
            }
        } catch (Exception $e) {
            // return redirect()->back();  
            dd($e);
        }


        // return redirect()->back();
        return to_route('list.products');
    }

    public function deleteProduct(Request $request)
    {
        $order = Order::where('user_id', Auth::id())
            ->where('status', 'active')
            ->first();
        $orderProduct = DetalsOrder::where('order_id', $order->id)
            ->where('product_id', $request->productId)
            ->first();
        $orderProduct->delete();
        return response()->json($request->productId);
    }

    public function updateOrder(Request $request)
    {
        $order = Order::where('user_id', Auth::id())
            ->where('status', 'active')
            ->first();
        if ($request->data) {

            $detal = DetalsOrder::where('order_id', $order->id)
                ->where('product_id', $request->data['id'])
                ->first();

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
                            'unit_amount'  =>  ($order->amount() * 100) ,
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
