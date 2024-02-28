<?php
namespace App\Helpers\Global;


class GetVATRate{

    public static function handler($transaction_product){
        if($transaction_product?->transaction?->contact?->bin){
            return ((float)($transaction_product->taxable_value * $transaction_product->tax_rate)) / 100;
        }
        return 0 ;
     }
}
