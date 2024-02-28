<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTaxRelation extends Model
{
    use HasFactory;
    protected $fillable = ['entity_product_id','tax_rate_id','nature_id'];

    public function company_product(){
        return $this->belongsTo(EntityProduct::class,'entity_product_id','id');
    }

    public function tax_rate(){
        return $this->belongsTo(TaxRate::class,'tax_rate_id','id');
    }

    public function nature_id(){
        return $this->belongsTo(TaxRate::class,'nature_id');
    }
}
