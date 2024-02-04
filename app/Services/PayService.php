<?php

namespace App\Services;

use Exception;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class PayService {

    public function payByStripe($order)
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
        }
    }
}