<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $fillable = [ 'document_id', 'transaction_id', 'log_date_time', 'old_status', 'new_status', 'body'];

    public function document(){
        return $this->belongsTo(Document::class,'document_id','id');
    }
    public function transaction(){
        return $this->belongsTo(Document::class,'transaction_id','id');
    }
}
