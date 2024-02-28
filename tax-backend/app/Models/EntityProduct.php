<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityProduct extends Model
{
    use HasFactory;
    protected $fillable = [
     'code',
     'hs_code',
     'title',
     'details',
     'unit',
      'cd',
     'sd_rate',
     'vat_rate',
     'ait',
     'rd',
     'at',
     'product_id',
     'entity_id',
     'is_tracking',
     'qty','unit_price'
    ];

    public function transactionProducts(){
        return $this->hasMany(TransactionProduct::class,'entity_product_id','id');
    }

    public function dictionary_product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
