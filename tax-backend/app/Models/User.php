<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'type',//type will be superadmin user
        'status',
        'avatar',
        'phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function role(){
        return $this->belongsToMany(Role::class,'user_role','user_id','role_id','id','id')->as('user_role')->withPivot('entity_id')->withTimestamps();
    }
    public function roleViaEntity($entity_id){
        return $this->role()->where([
             ['entity_id','=',$entity_id],
             ['user_id','=',$this->id],
            ])->first();
    }

    public function modulesPermissions(){
        return $this->belongsToMany(Entity::class,'entity_users','user_id','entity_id','id','id')->withPivot('module_id', 'module_permission_id')->withTimestamps();
    }

    public function entities(){
        return $this->belongsToMany(Entity::class,'user_role','user_id','entity_id','id','id')->as('user_entity');
    }
}
