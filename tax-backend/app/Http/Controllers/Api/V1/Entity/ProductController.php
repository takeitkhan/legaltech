<?php

namespace App\Http\Controllers\Api\V1\Entity;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getDictionaryProduct($product_hs_code){

        $product = Product::where('hs_code',$product_hs_code)->first();
        if($product){
            return response()->json(compact('product'));
        }
        return response()->json(['error'=>"Product not exist with this hs code!"],404);
    }
}
