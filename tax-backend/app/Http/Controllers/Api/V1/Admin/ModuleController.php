<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\ModulePermission;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function getModules(){
        $modules = Module::all();
        return response()->json(compact('modules'));
    }
    public function getModulesPermissions(){
        $modulePermissions = ModulePermission::all();
        return response()->json(compact('modulePermissions'));
    }
}
