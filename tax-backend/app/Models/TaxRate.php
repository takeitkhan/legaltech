<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxRate extends Model
{
    use HasFactory;
    protected $fillable = ['details','rate'];


    public function company(){
        return $this->belongsTo(Company::class,'company_id','id');
    }
}
