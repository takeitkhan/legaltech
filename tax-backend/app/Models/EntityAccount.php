<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityAccount extends Model
{
    use HasFactory;
    protected $fillable = ['entity_id','closing_balance_vat','closing_balance_sd'];

    public function entity(){
        return $this->belongsTo(Entity::class,'entity_id','id');
    }
}
