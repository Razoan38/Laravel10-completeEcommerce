<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class ProductsController extends Controller
{
     public function getCategory($category_slug)
     {
        $getCategory= Categories::getSingleslug($category_slug);

        if(!empty($getCategory))
        {
            $data['getCategory'] = $getCategory;
            return view('website.product.list',$data);
        }
        else{
            abort(404);
        }
     }
}
