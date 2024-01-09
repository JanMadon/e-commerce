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
use Symfony\Component\String\UnicodeString;

class OrderController extends Controller
{

    public function showMyOrders() {

        $orders = Order::with('detalsOrder')->where('user_id', Auth::id())->get();
        

        return Inertia::render('Admin/MyOrders', [
            'orders' => $orders,
        ]);

    }

    public function cart()
    {   
        $order = Order::where('user_id', Auth::user()->id)
            ->where('status', 'active')
            ->first();

            if(!$order){
                return Inertia::render('Admin/CartPage', [
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
        foreach($products as $product) {
            $photosNames = Storage::files("product/$product->id");
            $photoName = basename($photosNames[0]);
            $photo = Storage::get("product/$product->id/$photoName");
            $photo = base64_encode($photo);
            $product->photo = $photo;  
        }
        return Inertia::render('Admin/CartPage', [
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
                    $detalsOrder->quantity ++;
                    $detalsOrder->save();

               
                } else {
                    $detalsOrder = new DetalsOrder([
                        'order_id' => $order->id,
                        'product_id' => $request->id,
                        'quantity' => $request->quantity,
                    ]);
                    $detalsOrder->save();
                }// hamsko przeklejone jest

            } else {
                $order = Order::where('user_id', Auth::user()->id)
                    ->where('status', 'active')
                    ->first();

                // sprawdz czy istnieje już dodany produkt
                if (DetalsOrder::where('product_id', $request->id)->where('order_id', $order->id)->exists()) {
                    $detalsOrder = DetalsOrder::where('product_id', $request->id)->first();
                    $detalsOrder->quantity ++;
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

    public function deleteProduct(Request $request) {
        $order = Order::where('user_id', Auth::id())
            ->where('status', 'active')
            ->first();

        $orderProduct = DetalsOrder::where('order_id', $order->id)
                        ->where('product_id', $request->productId)
                        ->first();  
        
        $orderProduct->delete();
        
        return to_route('cart');
    }

    public function updateOrder(Request $request) {

        $request->validate([
            'quantity' => ['integer','min:1'],
        ]);
        
        $activeOrderForUser = Order::where('user_id', Auth::id())
                                ->where('status', 'active')
                                ->first(); 

        $product = DetalsOrder::where('order_id', $activeOrderForUser->id)
                                ->where('product_id', $request->id)
                                ->first();

        $product->quantity = $request->quantity;
        $product->save();
    }

    public function payOrder(Request $request){
        //dd($request->data->id);

        $order = Order::find($request->data['id']);
        $order->status = 'paid';
        $order->payd_at = Carbon::now();
        $order->save();
    }
}
