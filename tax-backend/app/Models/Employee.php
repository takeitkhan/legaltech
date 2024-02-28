<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['name','designation','phone','entity_id'];

    public function entity(){
        return $this->belongsTo(Company::class,'entity_id','id');
    }
}
