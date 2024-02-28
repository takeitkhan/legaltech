<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_id',
        'entity_product_id',
        'product_name',
        'unit',
        'unit_price',
        'qty',
        'sd_rate',
        'at_rate',
        'tax_rate',
        'ait',
        'rd',
        'cd',
        'taxable_value',
        'sd_rate_value',
        'tax_rate_value',
        'at_rate_value',
        'tax_rate_id',
    ];

    public function transaction(){
        return $this->belongsTo(Transaction::class,'transaction_id','id');
    }
    public function entity_product(){
        return $this->belongsTo(EntityProduct::class,'entity_product_id','id');
    }

    public function taxRate(){
        return $this->belongsTo(TaxRate::class,'tax_rate_id','id');
    }
}
