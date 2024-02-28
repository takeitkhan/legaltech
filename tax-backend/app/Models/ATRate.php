<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ATRate extends Model
{
    use HasFactory;
    protected $table = 'at_rates';
    protected $fillable = ['title','rate'];
}
