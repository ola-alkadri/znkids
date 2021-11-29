<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class UserController extends Controller
{
    
     public function login (Request $request)
     {
         $credentials = $request->only('email','password');
         $user = Auth::attempt($credentials);
         if($user)
         {
           return response()->json(Auth::user());
         }else{
            return response()->json('unexpected error please try later');
         }

     }
     public function logout (Request $request)
     {
        Auth::logout();
        return response()->json('logout done'); 
     }
     public function register (Request $request)
     {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'api_token' => Str::random(80),

        ]);
     }

     public function updateUser (Request $request, $id)
     {
        $old_user = User::find($id);
        $old_user->name = $request->name;
        $old_user->email = $request->email;
        $old_user->password = $request->password;
        $old_user->save();
        return response()->json($old_user);
     }

}
