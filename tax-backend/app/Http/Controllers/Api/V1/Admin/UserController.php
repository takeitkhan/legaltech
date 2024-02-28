<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Helpers\Global\UploadImage;
use App\Helpers\V1\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Entity;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($entity_id){
        // if(auth()->user()->type === 'superadmin'){
        //     $users = UserResource::collection(User::with('role','entities')->get());
        //     return response()->json(compact('users'));
        // }
        if(!$entity_id){
          return response()->json(['error'=>"Entity not found"],404);
        }
        else{
            $entity = Entity::findOrFail($entity_id);
            $userIds  = $entity->entity_role_users->pluck('id');
            $users    = User::with('role','entities')->whereIn('id',$userIds)->get();
            $users    = UserResource::collection($users,$entity_id);
            info('from usercontroller index page');
            return response()->json(compact('users'));
        }

    }

    public function authDetails(){
        $user = User::with(['role','entities'])->findOrFail(auth()->id());
        $user = new UserResource($user);
        if($user->type == 'superadmin'){
            return response()->json(compact('user'));
        }
        return response()->json(compact('user'));
    }

    //for adding user to the new Entity
    public function getUserViaPhone($phone){
        $user = User::with('role')->where('phone',$phone)->first();
        if(!$user || $user?->type == 'superadmin'){
            return $this->error("User Not Exist!",404);
        }
        $user = new UserResource($user);
        return response()->json(compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rulesArray = array(
            'name'      => "required|string",
            'role_id'   => "required",
            'entity_id' => "required",
        );
        if($request->has('id')){
            $rulesArray['phone'] = "required|string|min:11|max:11|unique:users,phone,".$request->id;
            $rulesArray['email'] = "required|email|unique:users,email,".$request->id;
        }
        else{
            $rulesArray['password'] = "required";
            $rulesArray['phone']  = "required|string|min:11|max:11|unique:users,phone";
            $rulesArray['avatar'] = 'required|image|mimes:png,jpg,jpeg|max:1014';
            $rulesArray['email'] = "required|email|unique:users,email";
        }

        $validator = Validator::make($request->all(),$rulesArray);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()],422);
        }

        try{
           DB::beginTransaction();
           $user = UserHelper::addNewUser($request);
           DB::commit();
           return $this->success($user,"New User Has been Created Successfully");
        }catch(Exception $e){
            DB::rollBack();
            return $this->error($e->getMessage(),500);
        }
    }

    public function update(Request $request){
        // return response()->json($request->all());
        $user_id   = (int)$request->input('id');
        $user = User::find($user_id);
        if(!$user){
            return response()->json(['error'=>"User Not Found"],404);
        }
        if($user->type === 'superadmin'){
            return response()->json(['error'=>"You can't update superadmin user"],404);
        }

        $rulesArray = array(
            'role_id'   => "required",
            'entity_id' => "required",
        );
        if(auth()->user()->type === 'superadmin'){
            $rulesArray['name'] =  "required|string";
            // $rulesArray['address'] =  "required|string";
            $rulesArray['email'] = "required|email|unique:users,email,".$request->id;
            // $rulesArray['password'] = "required";
            // $rulesArray['avatar'] = 'required|image|mimes:png,jpg,jpeg|max:1014';
        }


        $validator = Validator::make($request->all(),$rulesArray);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()],422);
        }
        try{
           DB::beginTransaction();
           $user = UserHelper::updateUser($request,$user);
           DB::commit();
           return $this->success($user,"User Has been Updated Successfully");
        }catch(Exception $e){
            DB::rollBack();
            return $this->error($e->getMessage(),500);
        }
    }

    public function destroy($entityId,$userId){
        $user = User::find($userId);

        if(!$user){
            return response()->json(['error'=>"User Not Found"],404);
        }
        try{
            DB::beginTransaction();
            $user->entities()->detach($entityId);
            DB::commit();
            return response()->json(['message'=>"User has been deleted Successfully"]);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json(['error'=>$e->getMessage()],404);
        }
    }

    public function getUserViaId($entityId,$userId){
        // if(auth()->user()->type === 'superadmin'){
        $user = User::with(['role','entities'])->find($userId);
        if(!$user){
            return response()->json(['error'=>"User Not Found"],404);
        }
        $role = $user->roleViaEntity($entityId);
        if(!$role){
            return response()->json(['error'=>"User Doesn't Exist in this entity"],404);
        }
        $user = new UserResource($user);
        return response()->json(['user'=>$user]);
        // }
    }
}
