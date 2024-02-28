<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['role_name'];

    public function users(){
        return $this->belongsToMany(User::class,'user_role','role_id','user_id','id','id');
    }
}
