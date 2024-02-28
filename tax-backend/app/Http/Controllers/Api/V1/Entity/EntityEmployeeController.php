<?php

namespace App\Http\Controllers\Api\V1\Entity;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EntityEmployeeController extends Controller
{
    public function entityEmployees($entity_id){
        $employees = Employee::where('entity_id',$entity_id)->get();
        return response()->json(compact('employees'));
    }
}
