<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankStatement extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'document_id'];
    public function document(){
        return $this->belongsTo(Document::class,'document_id');
    }
}
