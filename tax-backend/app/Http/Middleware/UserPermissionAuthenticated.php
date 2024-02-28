<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserPermissionAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {       
        $admin = ['dashboard','document_upload','users','docs','entity_list_nav','report_93','report_63'];
        $manager = ['dashboard','document_upload','users','docs','report_93'];
        $user = [];
        $data_entry_specialist = [];

        $logged_user = $request->user();
        $entity_id = $request->header('Entity'); 

        if($logged_user->role == 'Admin'){          
            $request['role_name'] = 'Admin';            
            $request['permissions'] = $admin;            
        }
        return $next($request);
        // return response()->json($request, 200);        
    }
}
