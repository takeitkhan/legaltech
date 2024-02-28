<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VATAdjustment extends Model
{
    use HasFactory;
    protected $table = 'vat_adjustments';
    protected $fillable = [
        'entity_id',
        'title',
        'amount',
        'adjustment_date',
        'adjustment_type',
        'vat_rate',
        'transaction_id'
    ]; //adjustment_type = increasing,decreasing

    public function entity()
    {
        return $this->belongsTo(Entity::class, 'entity_id', 'id');
    }
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }

    public function vat(){
        return $this->belongsTo(TaxRate::class,'vat_rate','id');
    }
}
