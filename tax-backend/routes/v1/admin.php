<?php
//super admin controller

use App\Http\Controllers\Api\V1\Admin\ContactsController;
use App\Http\Controllers\Api\V1\Admin\EntitiesController;
use App\Http\Controllers\Api\V1\Admin\ModuleController;
use App\Http\Controllers\Api\V1\Admin\RoleController;
use App\Http\Controllers\Api\V1\Admin\UserController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth:sanctum']], function () {
    //super admin routes -------- user crud
    
    Route::group(['prefix'=>'users'],function(){
        Route::post('/store',[UserController::class,'store']);
        Route::post('/update',[UserController::class,'update']);
        Route::post('/delete/{entityId}/{userId}',[UserController::class,'destroy']);
        Route::get('/getUserViaPhone/{phone}',[UserController::class,'getUserViaPhone']);
        Route::get('/getUser/{entityId}/{userId}',[UserController::class,'getUserViaId']);
        Route::get('/{entity_id}',[UserController::class,'index']);
    });
    

   //roles routes
   Route::get('/roles',[RoleController::class,'roles']);

   //module permissions
   Route::get('/modules',[ModuleController::class,'getModules']);
   Route::get('/permissions',[ModuleController::class,'getModulesPermissions']);

    //entities routes
    Route::prefix('/entities')->group(function(){
      Route::get('/getEntities',[EntitiesController::class,'getEntities']);
      Route::get('/',[EntitiesController::class,'index']);
      Route::get('/{entity}',[EntitiesController::class,'entityDetails']);
    });

   Route::group(['prefix'=>'/contacts'],function(){
       Route::get('/{contact}',[ContactsController::class,'show']);
       Route::post('/{contact}/destroy',[ContactsController::class,'destroy']);
       Route::post('/store',[ContactsController::class,'store']);
       Route::post('/update/{contact_id}',[ContactsController::class,'update']);
       Route::get('/',[ContactsController::class,'index']);
   });


//    Route::group(['prefix'])
});
