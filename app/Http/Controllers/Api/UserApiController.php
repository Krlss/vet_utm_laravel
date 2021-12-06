<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateUserApiRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserApiController extends Controller
{

    public function __construct(){}

   function Login (Request $request) {  
        try {
            $password = $request->password;

            $user = User::where('email', $request->email)->first();
            
            if($user){
                $passwordD = Hash::check($password, $user->password);
                if($passwordD){
                    return response()->json(['message'=>'Welcome', 'data' => $user], 200);
                }else{
                    return response()->json(['message'=>'Password incorrect', 'data' => null], 401);
                }
            }else{
                return response()->json(['message'=>'User not found', 'data' => null], 404); 
            }   
        } catch (\Throwable $th) {
           return response()->json(['message'=>'Something went error', 'data' => $th], 500);
        }     
   }


   function Register (CreateUserApiRequest $request) 
   {
    
   }
}
