<?php

namespace App\Services;

use App\Models\Order;
use Exception;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class PayService {

    public function payByStripe(Order $order)
    {  
        
       $data = [];  
       foreach($order->detalsOrder as $detal){
           $data[] = [
               'price_data' => [
                   'currency'     => 'PLN',
                   'product_data' => [
                       'name' => $detal->product->name,
                    ],
                    'unit_amount'  => $detal->product->price * 100,
                ],
                'quantity'   => $detal->quantity,
            ];
        }

        $data[] = [
            'price_data' => [
                'currency'     => 'PLN',
                'product_data' => [
                    'name' => 'shiping',
                 ],
                 'unit_amount'  => $order->shipingPrice() * 100,
             ],
             'quantity'   => 1,
         ];

        try {
            Stripe::setApiKey(config('stripe.sk'));

            $paySession = Session::create([
                'line_items' => [$data],
                'mode'        => 'payment',
                'success_url' => route('my.order', ['payment' => 'accepted']),
                'cancel_url'  => route('my.order.post', ['payment' => 'rejected']),
            ]);

            return $paySession->url;
        } catch (Exception $e) {
            return $e;
        }
    }
}