<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;
    protected $fillable = ['name','bin','address','tin','entity_type_id','ownership_type'];

    public function entity_type(){
        return $this->belongsTo(EntityType::class,'entity_type_id','id');
    }

    public function entity_role_users(){
        return $this->belongsToMany(User::class,'user_role','entity_id','user_id','id','id')->as('entity_users');
    }

    //company_users
    public function entity_users(){
        return $this->belongsToMany(User::class,'entity_users','entity_id','user_id','id','id');
    }

    public function modules(){
        return $this->belongsToMany(Module::class,'entity_users','entity_id','module_id','id','id');
    }
    public function module_permissions(){
        return $this->belongsToMany(ModulePermission::class,'entity_users','entity_id','module_permission_id','id','id');
    }

    public function employees(){
        return $this->hasMany(Employee::class,'entity_id','id');
    }

    public function contacts(){
        return $this->hasMany(Contact::class,'entity_id','id');
    }

    public function treasuryDeposits(){
        return $this->hasMany(TreasuryDeposit::class,'entity_id','id');
    }

    public function entity_account()
    {
      return $this->hasOne(EntityAccount::class,'entity_id','id');
    }

}
