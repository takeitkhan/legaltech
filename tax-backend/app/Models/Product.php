<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable = ['hs_code',
     'title', 'details',
     'unit', 'cd', 'sd_rakte',
      'vat_rate', 'ait',
      'rd', 'at'
    ];

}
