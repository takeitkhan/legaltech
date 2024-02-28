<?php
namespace App\Helpers\Global;


class GetSDRate{

  public static function handler($transaction_product){
       if($transaction_product?->transaction?->contact){
           return (($transaction_product->taxable_value * $transaction_product->sd_rate)) / 100;
       }
       return 0;
    }
}
