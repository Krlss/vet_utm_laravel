<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateUserApiRequest;
use App\Models\Canton;
use App\Models\Pet;
use App\Models\Province;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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


   function Register (Request $request) 
   {

    $input = $request->all();
    $input['api_token'] = Str::random(25);

    $userFind = User::where('user_id', $input['user_id'])
    ->where('email', $input['email'])
    ->first();
    if($userFind) return response()->json(['message'=>'the user is already created', 'data' => []], 401); 

    try {
        DB::beginTransaction();

        $user = User::create($input);

        DB::commit();
        return response()->json(['message'=>'Welcome', 'data' => $user], 200); 
    } catch (\Throwable $th) {
        return response()->json(['message'=>'Welcome', 'data' => []], 500); 
    }

   }

   function getProfile (Request $request) 
   {
    $header = $request->header('Authorization');
    if($header){
        $user = User::where('api_token', $header)->first();
        if($user){
            return response()->json(['message'=>'Your data :)', 'data' => $user], 200); 
        }
        return response()->json(['message'=>'User not found', 'data' => []], 404); 
    }else{
        return response()->json(['message'=>'you are not authorized to view that profile', 'data' => []], 401); 
    }

    return response()->json(['message'=>'Welcome', 'data' => []], 200); 
   }
}
