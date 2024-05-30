<?php

namespace App\Http\Controllers;

use App\Models\color;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductSize;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Models\DiscountCode;
use App\Models\order;
use App\Models\orderItem;
use App\Models\ShippingCharge;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;

use function PHPUnit\Framework\returnSelf;

class PaymentController extends Controller
{

    private $customer;

        public function checkout(Request $request)
        {
            
       $data['meta_title']       = 'Checkout';
       $data['meta_description'] = '';
       $data['meta_keywords']    = '';
       $data['getShipping']      = ShippingCharge::getRecordActive();

        return view('website.payment.checkout', $data);  
        }
        public function carts(Request $request)
        {
            
       $data['meta_title']       = 'cart';
       $data['meta_description'] = '';
       $data['meta_keywords']    = '';

        return view('website.payment.cart', $data);  
        }


    public function add_to_cart(Request $request) 
    {
        $getProduct = Product::getSingle($request->product_id);
        $total = $getProduct->price;
        if(!empty($request->size_id))
        {
            $size_id = $request->size_id;
            $getSize = ProductSize::getSingle($size_id);

            $size_price = !empty($getSize->price) ? $getSize->price : 0;
            $total = $total + $size_price;
        }
         else 
         {
            $size_id = 0;
         }
        $color_id = !empty($request->color_id) ? $request->color_id : 0;

         Cart::add([
            'id' => $getProduct->id,
            'name' => 'product',
            'price' => $total,
            'quantity' => $request->qty,
            'attributes' => array(
                'size_id' => $size_id,
                'color_id' => $color_id,
            )
         ]);

          return redirect()->back();
    }
public function update_cart(Request $request)
{
    foreach ($request->cart as $cart) {
        Cart::update($cart['id'], [
            'quantity' => [
                'relative' => false,
                'value' => $cart['qty'],
            ],
        ]);
    }

    return redirect()->back();
}


    public function carts_delete($id)
    {
       Cart::remove($id);
       return redirect()->back();
    }

    public function apply_discount_code(Request $request)
    {
        $getDiscount =   DiscountCode::CheckDiscount($request->discount_code);
          if(!empty($getDiscount))
          {
            $total = Cart::getSubTotal();
            if($getDiscount->type == 'Amount')
            {
                $discount_amount = $getDiscount->precent_amount;
                $payble_total = $total - $getDiscount->precent_amount;
            }
            else
            {
                $discount_amount =($total * $getDiscount->precent_amount) / 100;
                $payble_total = $total - $discount_amount;
            }

            $json['status'] =true ;
            $json['discount_amount'] =number_format($discount_amount , 2) ;
            $json['payble_total'] = number_format($payble_total, 2) ;
            $json['payble_total'] = $payble_total;
            $json['message'] ="success" ;
          }
          else  
          {
            $json['status'] =false ;
            $json['discount_amount'] = '0.00';
            $json['payble_total'] =Cart::getSubTotal() ;
            $json['message'] ="Discount Code Invalid" ;
          }

          echo json_encode($json);
    }

  
            public function place_order(Request $request)
        {
            // Validation and order processing logic
            $validated = 0;
            $message = '';

            if (!empty(Auth::check()))
            {
                $user_id = Auth::user()->id;
            } 
            else 
            {
                if (!empty($request->is_create)) {
                    // Check if the email is already registered
                    $checkEmail = User::CheckEmail($request->email);
                    if (!empty($checkEmail)) 
                    {
                        $message = "This email is already registered. Please choose another email address.";
                        $validated = 1;
                    } 
                    else 
                    {
                        // Create a new user if email is not registered
                        $save = new User();
                        $save->name = trim($request->first_name);
                        $save->email = trim($request->email);
                        $save->password = Hash::make($request->password);
                        $save->save();
    
                        $user_id = $save->id;
                    }
                }
                 else 
                {
                    $user_id = '';
                }
            }
            
            // Proceed with order placement if validation passes
            if (empty($validated)) {
                // Retrieve shipping details and calculate total amount
                $getShipping = ShippingCharge::getSingle($request->shipping);
                $payble_total = Cart::getSubTotal();
                $discount_amount = 0;
                $discount_code = '';
                
                // Check for discount code and apply discount if applicable
                if (!empty($request->discount_code)) {
                    $getDiscount =  DiscountCode::CheckDiscount($request->discount_code);
                    if (!empty($getDiscount)) {
                        $discount_code = $request->discount_code;
                        if ($getDiscount->type == 'Amount') {
                            $discount_amount = $getDiscount->precent_amount;
                            $payble_total -= $getDiscount->precent_amount;
                        } else {
                            $discount_amount = ($payble_total * $getDiscount->precent_amount) / 100;
                            $payble_total -= $discount_amount;
                        }
                    }
                }
                
                // Calculate shipping amount and total amount
                $shipping_amount = !empty($getShipping->price) ? $getShipping->price : 0;
                $total_amount = $payble_total + $shipping_amount;

                // Create an order instance and populate data
                $order = new Order();
                if (!empty($user_id)) {
                    $order->user_id =  trim($user_id);
                }
                $order->order_number =  trim($request->order_number);
                $order->first_name =  trim($request->first_name);
                $order->last_name =  trim($request->last_name);
                $order->company_name =  trim($request->company_name);
                $order->country =  trim($request->country);
                $order->address_one =  trim($request->address_one);
                $order->address_two =  trim($request->address_two);
                $order->city =  trim($request->city);
                $order->state =  trim($request->state);
                $order->postcode =  trim($request->postcode);
                $order->phone =  trim($request->phone);
                $order->email =  trim($request->email);
                $order->order_note =  trim($request->order_note);

                $order->shipping_id =  trim($request->shipping);
                $order->payment_method =  trim($request->payment_method);

                $order->discount_code =  trim($discount_code);
                $order->discount_amount =  trim($discount_amount);
                $order->shipping_amount =  trim($shipping_amount);
                $order->total_amount =  trim($total_amount);
                
                // Save the order
                $order->save();

                // Save order items
                foreach (Cart::getContent() as $key => $carts) {
                    $order_item = new OrderItem();
                    $order_item->order_id = $order->id;
                    $order_item->product_id = $carts->id;
                    $order_item->quantity = $carts->quantity;
                    $order_item->price = $carts->price;
                
                    $color_id = $carts->attributes->color_id;
                    if (!empty($color_id)) {
                        $getColor = Color::getSingle($color_id);
                        if ($getColor !== null) {
                            $order_item->color_name = $getColor->color_name;
                        }
                    }
                
                    $size_id = $carts->attributes->size_id;
                    if (!empty($size_id)) {
                        $getSize = ProductSize::getSingle($size_id);
                        if ($getSize !== null) {
                            $order_item->size_name = $getSize->name;
                            $order_item->size_amount = $getSize->price;
                        }
                    }
                
                    $order_item->total_price = $carts->price;
                    $order_item->save();
                }

                // Prepare JSON response
                $json['status'] = true;
                $json['message'] = "Order Success";
                $json['redirect'] =  url('checkout/payment?order_id='.base64_encode($order->id)) ;
            } else {
                // If validation fails, prepare error message
                $json['status'] = false;
                $json['message'] = $message;
            }
        
            // Return JSON response
            echo json_encode($json);
        }
      


     public function checkout_payment(Request $request)
     {
         if(!empty(Cart::getSubTotal()) && !empty($request->order_id))
         {
            $order_id = base64_decode($request->order_id);
            $getOrder = order::getSingle($order_id);

            if(!empty($getOrder))
            {
                if($getOrder->payment_method == 'cash')
                {
                    $getOrder->is_payment = 1;
                    $getOrder->save();

                    Cart::clear();
                     return redirect('/payment/carts')->with('success', "Order Successfully Placed ");
                 
        
                }

                elseif ($request->payment_method == 2)
                {
                    $sslPayment = new SslCommerzPaymentController();
                    $sslPayment->payViaAjax($request, $this->customer);
                }


               else if($getOrder->payment_method == 'Online')
                {
                    $query = array();
                    $query['business'] ="smrazoan01@gmail.com";
                    $query['cmd'] ='_xclick';
                    $query['item_name'] ='E-commerce';
                    $query['no_shipping'] ='1';
                    $query['item_number'] =$getOrder->id;
                    $query['amount'] =$getOrder->total_amount;
                    $query['currency_code'] ='USD';
                    $query['cancel_ruturn'] =url('checkout');
                    $query['ruturn'] =url('paypal/success-payment');


                    $query_string = http_build_query($query);

                    header('location: https://sandbox.sslcommerz.com/embed.min.js?' .$query_string);
                    exit();
                }
                
               else if($getOrder->payment_method == 'payoneer')
                {
               
                    $query = array();
                    $query['business'] ="smrazoan01@gmail.com";
                    $query['cmd'] ='_xclick';
                    $query['item_name'] ='E-commerce';
                    $query['no_shipping'] ='1';
                    $query['item_number'] =$getOrder->id;
                    $query['amount'] =$getOrder->total_amount;
                    $query['currency_code'] ='USD';
                    $query['cancel_ruturn'] =url('checkout');
                    $query['ruturn'] =url('paypal/success-payment');


                    $query_string = http_build_query($query);

                    header('location: https://www.sandbox.https://www.payoneer.com/bn/cgi-bin/webscr?' .$query_string);

                    exit();
                }


               else if($getOrder->payment_method == 'stripe')
                {
                    Stripe::setApiKey(env('STRIPE_SECRET'));
                    $finalprice = $getOrder->total_amount * 100;

                    $session = \Stripe\checkout\Session::create([
                        'customer_email' => $getOrder->email,
                        'payment_method_types' =>['card'],
                        'line_items' =>[[
                           'price_data' =>[

                            'currency' =>'usd',
                            'product_data' =>[
                                'name' =>'E-Commerce',
                            ],
                            'unit_amount' =>intval($finalprice),
                           ],
                           'quantity' =>1,
                        ]],
                        'mode' => 'payment',
                        'success_url' =>url('stripe/payment-success'),
                        'cancel_url' =>url('checkout'),
                    ]);

                    dd($session);
                }
            }
            else
            {
               abort(404);
            }

         }
         else
         {
            abort(404);
         }
     }   

    //  public function paypal_success_payment(Request $request)
    //  {
    //     dd($request->all());
    //  }

   

}
