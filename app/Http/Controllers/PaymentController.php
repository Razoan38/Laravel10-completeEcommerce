<?php

namespace App\Http\Controllers;

use App\Models\color;
use Illuminate\Http\Request;
// use Darryldecode\Cart\Cart;
use App\Models\Product;
use App\Models\ProductSize;
use Darryldecode\Cart\Facades\CartFacade as Cart;

use function PHPUnit\Framework\returnSelf;

class PaymentController extends Controller
{
    public function carts(Request $request)
    {
        return view('website.payment.cart');
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
}
