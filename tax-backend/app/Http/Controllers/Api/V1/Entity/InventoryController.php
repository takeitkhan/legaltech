<?php

namespace App\Http\Controllers\Api\V1\Entity;

use App\Helpers\V1\InventoryHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionProductsOrServicesResource;
use App\Models\TransactionProduct;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InventoryController extends Controller
{
    public function registerProduct(Request $request,$entityId){

        // ait: "34"
        // atRate: 0
        // cd: "34"
        // details: "asdfsdf"
        // dictionaryProductId: null
        // is_tracking: false
        // productCode: "asdfasdf"
        // productHSCode: "34335"
        // productId: "new_product"
        // productName: "dfasdfasdf"
        // product_unit: "3434"
        // qty: 1
        // rd: "34"
        // sdRate: "3"
        // taxValue: 0
        // taxable_value: "43"
        // unit_price: "443"
        // vatRate: "3"
        $request->validate([
          'productId' => 'required',
          'productCode' => Rule::requiredIf($request->productId === 'new_product'),
          'productName' => Rule::requiredIf($request->productId === 'new_product'),
          'product_unit' => Rule::requiredIf($request->productId === 'new_product'),
          'vatRate' => Rule::requiredIf($request->productId === 'new_product'),
        ]);

        $response = InventoryHelper::storeEntityProduct($request,$entityId);
        if($response['error'] === true){
            return response()->json(['error'=>$response['message']],500);
        }
        return response()->json(['message'=> $response['message']]);
    }


    public function transactionProducts($entityId,$entityProductId){
        $transactionProducts = TransactionProduct::with(['transaction','entity_product','taxRate'])
        ->join('transactions','transactions.id','=','transaction_products.transaction_id')
        ->where(function($query)use($entityId,$entityProductId){
            $conditionArray = [
                ['transactions.entity_id','=',$entityId],
                ['transaction_products.entity_product_id','=',$entityProductId],
            ];
            $query->where($conditionArray);
        })->select('transaction_products.*')->orderBy('transactions.transaction_date', 'asc')->get();
        if($transactionProducts->count() == 0 ){
            return response()->json(['error'=>'Transaction Products not found'],404);
        }
        $transactionProducts = TransactionProductsOrServicesResource::collection($transactionProducts);
        return response()->json(compact('transactionProducts'));
    }
}
