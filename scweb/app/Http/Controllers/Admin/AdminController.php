<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $total_services = \App\Models\Service::count();
        $total_members  = \App\Models\Member::count();
        return view('admin.index',compact('total_services','total_members'));
    }
}
