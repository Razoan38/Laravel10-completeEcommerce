<?php

namespace App\Http\Controllers;

use App\Models\color;
use Illuminate\Http\Request;
// use Darryldecode\Cart\Cart;
use App\Models\Product;
use App\Models\ProductSize;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Models\DiscountCode;
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
        dd($request->all());
    }
}
