<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Stripe;
use Illuminate\Support\Facades\Session;


class Checkout extends Component
{

    public $name,  $fname, $lname, $email, $phone, $country, $address1;
    public $card_name, $card_number, $csv, $exp_month, $exp_year;

    // public $users, $fname,$lname,  $email, $password, $name;

   
    public function render()
    {
         
        return view('livewire.frontend.checkout')
        ->layout('components.master');
    }

    public function makeCheckout(Request $request){

        // Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        // $stripe = new \Stripe\StripeClient('sk_test_51OQS5ISAPqHnZjaeHh8dpucpw5yPAkQ17OcEszPwlEMe3rilr9cQtXhlYs1y5Hx5ER7sAAKc6V8nSjPQfqWsvyS900BflqMnnQ');
    
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        // $redirectUrl = route('stripe.checkout.success').'?session_id={CHECKOUT_SESSION_ID}';

        // $stripe->customers->create([
        //     'name' => 'Albert Pinto',
        //     'address' => [
        //       'line1' => '510 Townsend St',
        //       'postal_code' => '111111',
        //       'city' => 'ABCD',
        //       'state' => 'GOA',
        //       'country' => 'IN',
        //     ],
        //   ]);

        //   $stripe->paymentIntents->create([
        //     'description' => 'Software development services',
        //     'shipping' => [
        //       'name' => 'Albert Pinto',
        //       'address' => [
        //         'line1' => '510 Townsend St',
        //         'postal_code' => '111111',
        //         'city' => 'ABCD',
        //         'state' => 'GOA',
        //         'country' => 'IN',
        //       ],
        //     ],
        //     'amount' => 100*118,
        //     'currency' => 'INR',
        //     'payment_method_types' => ['card'],
        //   ]);

        $response = $stripe->checkout->sessions->create([
            'success_url' => 'http://localhost:4242/Home',

            'customer_email' => 'demo@gmail.com',

            // 'payment_method_types' => ['card'],

            'line_items' => [
                [
                    'price_data' => [
                        'product_data' => [
                            'name' => 'ABCD',
                        ],
                        'unit_amount' => 100 * 119,
                        'currency' => 'INR',
                    ],
                    'quantity' => 1
                ],
            ],

            'mode' => 'payment',
            'allow_promotion_codes' => true,
        ]);

        return redirect($response['url']);

    }

   
}
