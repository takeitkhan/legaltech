<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = ['entity_id', 'name', 'bin', 'contact_person', 'nid', 'address','contact_code','VDS_certificate','VDS_certificate'];

    public function entity(){
        return $this->belongsTo(Entity::class,'entity_id','id');
    }

    public function transactions(){
        return $this->hasMany(Transaction::class,'contact_id','id');
    }
}
