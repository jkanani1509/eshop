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


        
// $stripe = new \Stripe\StripeClient('sk_test_51OQS5ISAPqHnZjaeHh8dpucpw5yPAkQ17OcEszPwlEMe3rilr9cQtXhlYs1y5Hx5ER7sAAKc6V8nSjPQfqWsvyS900BflqMnnQ');
// $stripe->checkout->sessions->create([
//   'success_url' => 'https://example.com/success',
//   'line_items' => [
//     [
//       'price' => 'price_1MotwRLkdIwHu7ixYcPLm5uZ',
//       'quantity' => 2,
//     ],
//   ],
//   'mode' => 'payment',
// ]);

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $stripe = new \Stripe\StripeClient('sk_test_51OQS5ISAPqHnZjaeHh8dpucpw5yPAkQ17OcEszPwlEMe3rilr9cQtXhlYs1y5Hx5ER7sAAKc6V8nSjPQfqWsvyS900BflqMnnQ');
dump("AAAA");     
error_reporting(E_ALL);   
        $checkout_session = $stripe->checkout->sessions->create([
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
          'success_url' => 'http://localhost:4242/Home',
          'cancel_url' => 'http://localhost:4242/login',
        ]);
        dump($checkout_session->url); 
        dump("BBBB"); 
?>
        <script> location.href = "<?php echo $checkout_session->url ?>";  </script>

        <?php 
        // header("HTTP/1.1 303 See Other");
       
        // header("Location: " . $checkout_session->url);

        
    
        session::flash('success', 'Payment successful!');
              
        dump("Payment successful!");
        // return back();

    }

   
}
