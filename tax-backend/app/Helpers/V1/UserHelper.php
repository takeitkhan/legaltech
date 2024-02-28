<?php
namespace App\Helpers\V1;

use App\Helpers\Global\UploadImage;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;

class UserHelper{

  public static function uploadFile($file){
    $public_path = public_path('/images/avatar');
    $file_name = 'avatar_'.Str::random(5).'.'.$file->extension();
    $file_name = UploadImage::uploadImage($file,$public_path,$file_name );
    return $file_name;
  }

  public static function  addNewUser(Request $request){

    $data = array(
        'name'       => $request->input('name'),
        'email'      => $request->input('email'),
        'phone'      => $request->input('phone'),
        'address'    => $request->input('address'),
        'type'       => 'user',
        'status'     => $request->input('status')?$request->input('status'):'inactive',
    );

    if($request->has('password')){
        $data['password'] = bcrypt(json_decode($request->input('password')));
    }

    if($request->hasFile('avatar') && $request->avatar->isValid()){
        $file_name = self::uploadFile($request->file('avatar'));
        $data['avatar'] = $file_name;
    }

    $user_id   = (int)$request->input('id');
    $entity_id = (int)$request->input('entity_id');
    $role_id   = (int)$request->input('role_id');
    if(!$role_id){
        throw new Exception("Role field is required");
    }
    if(!$entity_id){
        throw new Exception("Please select entity id");
    }

    if($user_id){
        $user = User::findOrFail($user_id);
        if($user->type === 'superadmin'){
            throw new Exception("You can't add superadmin as user");
        }
        $isUserRoleEntityExist = $user->role()->where([
            ['entity_id','=',$entity_id],
        ])->count();
        if($isUserRoleEntityExist){
            $user->entities()->detach($entity_id);
            $user->role()->attach($role_id,['entity_id'=>$entity_id]);
        }
        else{
            $user->role()->attach($role_id,['entity_id'=>$entity_id]);
        }
        $user->update($data);
    }
    else{
        $user = User::create($data);
        $user->role()->attach($role_id,['entity_id'=>$entity_id]);
    }
    return $user;


    // self::addModulePermission($user,$request->input('entity_id'),json_decode($request->input('modules')));
  }

  public static function updateUser(Request $request,$user){

    $entity_id = (int)$request->input('entity_id');
    $role_id    = (int)$request->input('role_id');
    if(!$role_id){
        throw new Exception("Role field is required");
    }
    if(!$entity_id){
        throw new Exception("Please select entity id");
    }

    if(auth()->user()->type === 'superadmin'){
        self::updateUserData($request,$user);
    }

    $user->entities()->detach($entity_id);//delete user from this entites
    $user->role()->attach($role_id,['entity_id'=>$entity_id]);
    // $user->update($data);
    return $user;

  }

  protected static function updateUserData(Request $request,$user){
    $data = array(
        'name'       => $request->input('name'),
        'email'      => $request->input('email'),
        'phone'      => $request->input('phone'),
        'type'       => 'user',
        'status'     => $request->input('status')?$request->input('status'):'inactive',
    );
    if($request->hasFile('avatar') && $request->avatar->isValid()){
        $file_name = self::uploadFile($request->file('avatar'));
        $data['avatar'] = $file_name;
    }

    if($request->has('address')){
        $data['address']  = $request->input('address');
    }
    if($request->has('password')){
        $data['password']  = bcrypt(json_decode($request->input('password')));
    }
    $user->update($data);

  }

  public static function updateUserProfile(Request $request, User $user){

    $data = array(
        'name'     => $request->input('name'),
        'email'    => $request->input('email'),
        'phone'    => $request->input('phone'),
        'status'   => $request->input('status') === 'active'?'active':'inactive',
    );

    if($request->has('password') && !empty($request->password)){
        $data['password'] = bcrypt(json_decode($request->input('password')));
    }
    if($request->has('address') && !empty($request->address)){
        $data['address'] = $request->input('address');
    }
    if($request->hasFile('avatar') && $request->avatar->isValid()){
        $file_name = self::uploadFile($request->file('avatar'));
        $file_path = public_path('images/avatar/'.$user->avatar);
        $isExists  = file_exists($file_path);
        if($isExists) {
          unlink($file_path);
        }
        $data['avatar'] = $file_name;
    }
    $user->update($data);
    return $user;
  }

  protected  static function addModulePermission($user,$entity_id,$modules){
    //modules =  [
    // {"module_id":1,"permissions":[2,1,3]},
    // {"module_id":2,"permissions":[1,2,3]},
    // {"module_id":3,"permissions":[1,2,3]},
    // {"module_id":4,"permissions":[1]}
    // ]
    foreach($modules as $single){
        foreach($single->permissions as $permission){
            $pivotData = ['module_id'=>$single->module_id,'module_permission_id'=>$permission];
            $user->modulesPermissions()->attach($entity_id,$pivotData);
        }
    }

  }
}
