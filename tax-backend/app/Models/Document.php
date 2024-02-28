<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'file_extension',
        'user_id',
        'transaction_id',
        'entity_id',
        'document_type_id',
        'status'
    ];

    public function uploadUser(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    
    public function entity(){
        return $this->belongsTo(Entity::class,'entity_id','id');
    }
    public function document_type(){
        return $this->belongsTo(DocumentType::class,'document_type_id','id');
    }
    public function transaction(){
        return $this->belongsTo(Transaction::class,'transaction_id','id');
    }
}
