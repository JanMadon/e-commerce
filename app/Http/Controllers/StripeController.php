<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class StripeController extends Controller
{
    // public function index() 
    // {
    //     return view('index');
    // }

    // public function checkout() 
    // {
    //     Stripe::setApiKey(config('stripe.sk'));
        
    //     $session = Session::create([
    //         'line_items'=>[
    //             [
    //                 'price_data' => [
    //                     'currency'     => 'gbp',
    //                     'product_data' => [
    //                         'name' => 'gimme money!!!!',
    //                     ],
    //                     'unit_amount'  => 500,
    //                 ],
    //                 'quantity'   => 1,
    //             ],
    //         ],
    //         'mode'        => 'payment',
    //         'success_url' => route('success'),
    //         'cancel_url'  => route('checkout'),
    //     ]);

    //     dd($session);
        

    //     return Inertia::render('Dashboard', ['kay' => 'value']);

    //     //return back(300, ['kay'=>'value']);
    //     //return redirect()->away('https://www.google.pl/webhp');
    // }

    // public function success() 
    // {
    //     return "Yay, It works!!!";
    // }
}
