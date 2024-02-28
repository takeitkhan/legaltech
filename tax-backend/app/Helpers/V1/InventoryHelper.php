<?php

namespace App\Helpers\V1;

use App\Models\EntityProduct;
use Exception;
use Illuminate\Http\Request;

class InventoryHelper
{

    public static function storeEntityProduct(Request $request, $entity_id)
    {
        //new_product 
        try {
            if ($request->productId !== 'new_product') {
                $entityProduct = EntityProduct::find($request->productId);
                if (!$entityProduct) {
                    throw new Exception('Product does not exist!');
                }
                if ($entityProduct->is_tracking === '1') {
                    return ['message' => 'product has already tracked', 'error' => true];
                }
                $entityProduct->update(['is_tracking' => '1']);
                return ['error' => false, 'message' => 'Product is now Tracking successfully!'];
            }

            $entityProductData = array(
                'code'      => $request->input('productCode'),
                'hs_code'  => $request->input('productHSCode') ? $request->input('productHSCode') : null,
                'title'    => $request->input('productName'),
                'details'  => $request->input('details'),
                'unit'     => $request->input('unit'),
                'cd'       => $request->input('cd') ? $request->input('cd') : 0,
                'sd_rate'  => $request->input('sdRate') ? $request->input('sdRate') : 0,
                'vat_rate' => $request->input('vatRate') ? $request->input('vatRate') : 0,
                'ait'      => $request->input('ait') ?  $request->input('ait') : 0,
                'rd'       => $request->input('rd') ? $request->input('rd') : 0,
                'at'       => $request->input('at') ? $request->input('at') : 0,
                'product_id'  => $request->input('dictionaryProductId') ? $request->input('dictionaryProductId') : null,
                'entity_id'   => $entity_id,
                'is_tracking' => $request->input('is_tracking') ? '1' : '0',
                'qty'        => $request->input('qty') ? $request->input('qty') : 0,
                'unit_price'  => $request->input('unit_price') && $request->input('qty') ? $request->input('unit_price') * $request->input('qty') : 0
            );
            $entityProduct = EntityProduct::create($entityProductData);
            return ['error' => false, 'message' => 'Product has been created successfully!'];
        } catch (Exception $e) {
            return ['message' => $e->getMessage(), 'error' => true];
        }
    }
}
