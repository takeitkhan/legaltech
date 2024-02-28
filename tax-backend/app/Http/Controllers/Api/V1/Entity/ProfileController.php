<?php

namespace App\Http\Controllers\Api\V1\Entity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Helpers\V1\UserHelper;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function profile_update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            // 'avatar'    => 'required|image|mimes:png,jpg,jpeg|max:1014',
            'name'      => "required|string",
            'email'     =>  "required|email",
            'phone'      => "required|string",
        ]);



        if($validator->fails()){
            return  response()->json(['errors'=>$validator->errors()],422);
        }

        $id = $request->user()->id;

        $user = User::find($id);
        if(!$user){
            return $this->error("Confirm Password Field is required", 422);
        }


        if($request->has('password') && $request->password !== null){

          if($request->old_password && Hash::check($request->old_password, $user->password)){
            if($request->has('confirm_password') && $request->confirm_password){
                if($request->password !== $request->confirm_password){
                  return $this->error("Confirm Password not match!", 401);
                }
            }else{
                return $this->error("Confirm Password Field is required", 422);
            }
          }else{
            return $this->error("Old password not match!", 401);
          }

        }

        try{
           DB::beginTransaction();
           $user = UserHelper::updateUserProfile($request, $user);
           DB::commit();
           return $this->success($user,"User profile update successfully!");
        }catch(Exception $e){
            DB::rollBack();
            return $this->error($e->getMessage(),500);
        }
    }

    //End
}
