<?php

namespace App\Http\Controllers\Api\V1\Entity;

use App\Http\Controllers\Controller;
use App\Http\Resources\EntityResource;
use App\Models\Entity;
use App\Models\User;
use Illuminate\Http\Request;

class EntityController extends Controller
{
    public function index(){
        if(auth()->user()->type === 'superadmin'){
            $entities = Entity::with('entity_role_users')->get();
        }
        else{
            $user     = User::find(auth()->id());
            $entities = $user->entities->pluck('id');
            $entities = Entity::with('entity_role_users')->whereIn('id',$entities)->get();
        }
        $entities = EntityResource::collection($entities);
        return response()->json(compact('entities'));
    }
}
