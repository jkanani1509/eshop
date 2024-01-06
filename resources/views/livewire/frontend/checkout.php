<?php

require_once '../../../../vendor/autoload.php';
// require_once '../secrets.php';

$stripeSecretKey = 'sk_test_51OQS5ISAPqHnZjaeHh8dpucpw5yPAkQ17OcEszPwlEMe3rilr9cQtXhlYs1y5Hx5ER7sAAKc6V8nSjPQfqWsvyS900BflqMnnQ';


\Stripe\Stripe::setApiKey($stripeSecretKey);
header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost:4242';

$checkout_session = \Stripe\Checkout\Session::create([
  
  'line_items' => [[
    'price_data' => [
      'currency' => 'INR',
      'product_data' => [
        'name' => 'T-shirt',
      ],
      'unit_amount' => 112,
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'payment_method_types' => ['card'],
  'success_url' => 'http://localhost:4242/Home',
  'cancel_url' => 'http://localhost:4242/login',
]);



header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);