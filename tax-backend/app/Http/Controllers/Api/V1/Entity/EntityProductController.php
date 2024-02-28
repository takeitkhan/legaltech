<?php

namespace App\Http\Controllers\Api\V1\Entity;

use App\Http\Controllers\Controller;
use App\Models\EntityProduct;
use Illuminate\Http\Request;

class EntityProductController extends Controller
{
    public function getEntityProduct($entity_id,$product_code){
        $entity_product = EntityProduct::where([['code','=',$product_code],['entity_id','=',$entity_id]])->first();
        return response()->json(compact('entity_product'));
    }
    public function entityProductList($entity_id){
        $entityProducts = EntityProduct::where([
            ['entity_id',$entity_id],
            ['is_tracking','=','1']
        ])->get();
        return response()->json(compact('entityProducts'));
    }

    public function getProductViaId($entity_id,$product_id){
        $entityProduct = EntityProduct::where([
                            ['entity_id','=',$entity_id],
                            ['id','=',$product_id],
                        ])->first();
        return response()->json(compact('entityProduct'));
    }

    public function entityUntrackingProducts($entity_id)
    {
        $entityUntrackingProducts = EntityProduct::where([
            ['entity_id',$entity_id],
            ['is_tracking','=','0']
        ])->get();
        return response()->json(compact('entityUntrackingProducts'));
    }


}
