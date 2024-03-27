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



use function PHPUnit\Framework\returnSelf;

class PaymentController extends Controller
{
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
        // dd($request->all());
        $getShipping = ShippingCharge::getSingle($request->shipping);
        $payble_total = Cart::getSubTotal();
        $discount_amount = 0;
        $discount_code = '';
        
        if(!empty($request->discount_code))
        {
            $getDiscount =  DiscountCode::CheckDiscount($request->discount_code);
          
            if(!empty($getDiscount))
            {
                $discount_code = $request->discount_code;
                if($getDiscount->type == 'Amount')
                {
                    $discount_amount = $getDiscount->precent_amount;
                    $payble_total = $payble_total - $getDiscount->precent_amount;
                }
                else
                {
                    $discount_amount =($payble_total * $getDiscount->precent_amount) / 100;
                    $payble_total = $payble_total - $discount_amount;
                }
            }
         
        }
        
        $shipping_amount = !empty($getShipping->price) ? $getShipping->price : 0;
        $total_amount = $payble_total + $shipping_amount;

        $order =new  order();
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
        // $order->payment_data =  trim($request->payment_data);

        // $order->status =  trim($request->status);
        // $order->is_delete =  trim($request->is_delete);
        $order->save();
       

      

        foreach (Cart::getContent() as $key => $carts) {
            $order_item = new orderItem();
            $order_item->order_id = $order->id;
            $order_item->product_id = $carts->id;
            $order_item->quantity = $carts->quantity;
            $order_item->price = $carts->price;
        
            $color_id = $carts->attributes->color_id;
            if (!empty($color_id)) {
                $getColor = color::getSingle($color_id);
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
        
      die;

    }
}
