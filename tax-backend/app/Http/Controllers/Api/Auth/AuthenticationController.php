<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed'
        ]);


        $user = User::create([
            'name'     => $request->input('name'),
            'password' => bcrypt($request->input('password')),
            'email'    => $request->input['email']
        ]);

        return $this->success([
            'token' => $user->createToken('API_Token')->plainTextToken,
            'user' => $user,
        ]);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string|min:6'
        ]);
        // return $request->all();
        $user = User::with(['role','entities'])->where('phone',$request->input('phone'))->first();
        if(!$user){
            return $this->error('User not found', 401);
        }



        if(!Hash::check($request->password,$user->password)){
            return $this->error('Password not match', 401);
        }

        if (!Auth::attempt($data)) {
            return $this->error('Credentials not match', 401);
        }
        $user = User::with(['role','entities'])->findOrFail(auth()->id());
        $user = new UserResource($user);
        return $this->success([
            'token' => auth()->user()->createToken('API Token')->plainTextToken,
            'user' =>  $user,
        ],"You are logged in successfully");
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this->success([
            'message' => 'You are Logged In Successfully'
        ]);
    }

}
