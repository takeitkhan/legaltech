<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreasuryDeposit extends Model
{
    use HasFactory;
    protected $fillable = [
        'treasury_challan_number',
        'bank','branch','district',
        'date','entity_id',
        'deposit_account_code',
        'deposit_amount',
        'deposit_type','transaction_id'
    ];

    public function entity(){
        return $this->belongsTo(Entity::class,'entity_id','id');
    }
    
    public function transaction(){
        return $this->belongsTo(Transaction::class,'transaction_id','id');
    }
}
