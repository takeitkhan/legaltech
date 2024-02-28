<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\EntityResource;
use App\Models\Entity;
use Illuminate\Http\Request;

class EntitiesController extends Controller
{

    public function index(){
        $entities = EntityResource::collection(Entity::with('entity_type','entity_role_users')->get());
        return response()->json(compact('entities'));
    }

    public function entityDetails(Entity $entity){
        $entity = new  EntityResource($entity);
        return response()->json(compact('entity'));
    }
    public function getEntities(){
      $entities = Entity::select('name','id')->get();
      return response()->json(compact('entities'));
    }
}
