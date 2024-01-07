<?php

namespace App\Http\Controllers;

use App\Models\DetalsOrder;
use App\Models\Order;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function create(Request $request) 
    {
        
        $request->validate([
            'id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'min:1']
        ]);

        dd($request['quantity']);
        
        try{
            if (!Order::where('user_id', Auth::user()->id)->exists()) {

                $order = new Order([
                    'user_id' => Auth::user()->id,
                    'status' => 'active',    
                ]);
                $order->save();
            } else {
                $order = Order::where('user_id', Auth::user()->id)
                    ->where('status', 'active')
                    ->first();
            }
            
            
            $detalsOrder = new DetalsOrder([
                'order_id' => $order->id,
                'product_id' => $request->id,
                'quantity' => $request->quantity,
            ]);
            $detalsOrder->save();
            $detalsOrder = DetalsOrder::get();

            session()->flash('success', 'The product has been added to the cart.');

        } catch(Exception $e) {
            // return redirect()->back();    
        }
        

        // return redirect()->back();
        return to_route('list.products');
    }
}
