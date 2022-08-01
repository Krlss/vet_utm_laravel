<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateUserApiRequest;
use App\Http\Requests\CreateUserRequest;
use App\Mail\AccountVerifyEmail;
use App\Models\Canton;
use App\Models\Image;
use App\Models\Parish;
use App\Models\Pet;
use App\Models\Province;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class UserApiController extends Controller
{

    public function __construct()
    {
    }

    function Login(Request $request)
    {
        try {
            $password = $request->password;

            $user = User::where('email', strtolower($request->email))->first();

            if ($user) {
                $passwordD = Hash::check($password, $user->password);
                if ($passwordD) {
                    if ($user->email_verified_at == null) {
                        Mail::to($user->email)->send(new AccountVerifyEmail($user));
                        return response()->json([
                            'type' => 'info',
                            'title' => __('Active your account'),
                            'message' => __('Follow the instructions that have been sent to the email')
                        ], 301);
                    }
                    $user->pets;
                    $user->canton;
                    $user->province;
                    $user->parish;

                    /* for ($i = 0; $i < count($pet); $i++) {
                        if ($pet[$i]->specie)
                            $pet[$i]['image_specie'] = $pet[$i]->specie->image ? $pet[$i]->specie->image->url : null;
                        $pet[$i]['images'] = $pet[$i]->images;
                        $pet[$i]['specie'] = $pet[$i]->specie->name;
                        $pet[$i]['race'] = $pet[$i]->race->name;
                    } */

                    return response()->json([
                        'type' => 'success',
                        'title' => __('Login success'),
                        'message' => __('Welcome again!'),
                        'user' => $user
                    ], 200);
                } else {
                    return response()->json([
                        'type' => 'error',
                        'title' => __('Login failed'),
                        'message' => __('These credentials do not match our records')
                    ], 401);
                }
            } else {
                if (strpos($request->email, "utm.edu.ec")) {
                    /* usuario utm */
                    try {
                        $response = Http::withHeaders([
                            'X-API-KEY' => '3ecbcb4e62a00d2bc58080218a4376f24a8079e1',
                        ])->withOptions(["verify" => false])->post('https://app.utm.edu.ec/becas/api/publico/IniciaSesion', [
                            'usuario' => $request->email,
                            'clave' => $request->password,
                        ]);
                        $output = $response->json();
                    } catch (\Throwable $th) {
                        return response()->json([
                            'type' => 'error',
                            'title' => __('Something went wrong'),
                            'message' => __('There was an error on the server, please try again later')
                        ], 500);
                    }
                    if ($output["state"] == "success") {

                        $usuario_utm = $output["value"];
                        $nombres_utm = explode(" ", $usuario_utm["nombres"], 3);
                        $PhotoPath = generateProfilePhotoPath($nombres_utm["2"]);

                        $id_province = Province::where('name', 'Manabi')
                            ->orWhere('name', 'Manabí')
                            ->orWhere('name', 'manabí')
                            ->orWhere('name', 'manabi')
                            ->orWhere('name', 'MANABI')
                            ->orWhere('name', 'MANABÍ')
                            ->first()
                            ->id;


                        $new_user = User::create([
                            'user_id' => $usuario_utm["cedula"],
                            'name' => $nombres_utm["2"],
                            'last_name1' => $nombres_utm["0"],
                            'last_name2' => $nombres_utm["1"],
                            'email' => $request->email,
                            'password' => Hash::make($request->password),
                            'email_verified_at' => date('Y-m-d h:i:s'),
                            'id_province' => $id_province ?? 1,
                            'api_token' => Str::random(25),
                            'profile_photo_path' => $PhotoPath,
                        ]);

                        $new_user->pets;
                        $new_user->canton;
                        $new_user->province;
                        $new_user->parish;

                        return response()->json([
                            'type' => 'success',
                            'title' => __('Login success'),
                            'message' => __('Welcome again!'),
                            'user' => $new_user
                        ], 200);
                    } else {
                        return response()->json([
                            'type' => 'error',
                            'title' => __('Login failed'),
                            'message' => __('These credentials do not match our records')
                        ], 401);
                    }
                }
                return response()->json([
                    'type' => 'error',
                    'title' => __('Login failed'),
                    'message' => __('These credentials do not match our records')
                ], 401);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'type' => 'error',
                'title' => __('Something went wrong'),
                'message' => __('There was an error on the server, please try again later')
            ], 500);
        }
    }


    function Register(CreateUserApiRequest $request)
    {

        $input = $request->all();
        $input['api_token'] = Str::random(25);
        $input['password'] = Hash::make($input['password']);

        try {
            if (isset($input['user_id']))
                validateUserID($input['user_id']);
        } catch (Exception $e) {
            return response()->json([
                'type' => 'error',
                'title' => __('Error in create user'),
                'message' => __('CI/RUC is invalid')
            ], 401);
        }

        $input['email'] = strtolower($input['email']);

        //Por defecto manabí...
        $id_province = Province::where('name', 'Manabi')
            ->orWhere('name', 'Manabí')
            ->orWhere('name', 'manabí')
            ->orWhere('name', 'manabi')
            ->orWhere('name', 'MANABI')
            ->orWhere('name', 'MANABÍ')
            ->first()
            ->id;

        $input['id_province'] = $id_province;

        try {
            DB::beginTransaction();
            if (isset($input['name'])) {
                $input['name'] = ucwords(strtolower($input['name']));
                $input['profile_photo_path'] = generateProfilePhotoPath($input['name']);
            }
            if (isset($input['last_name1']))  $input['last_name1'] = ucwords(strtolower($input['last_name1']));
            if (isset($input['last_name2']))  $input['last_name2'] = ucwords(strtolower($input['last_name2']));
            User::create($input);

            DB::commit();
            return response()->json([
                'type' => 'success',
                'title' => __('Register success'),
                'message' => __('Now you can login')
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'type' => 'error',
                'title' => __('Something went wrong'),
                'message' => __('There was an error on the server, please try again later')
            ], 500);
        }
    }

    function getProfile(Request $request)
    {
        $header = $request->header('Authorization');
        if ($header) {
            $user = User::where('api_token', $header)->first();
            if ($user) {
                $pet = $user->pets;
                $user->canton;
                $user->province;
                $user->parish;

                for ($i = 0; $i < count($pet); $i++) {
                    if ($user->pets[$i]->specie)
                        $user->pets[$i]['image_specie'] = $pet[$i]->specie->image ? $pet[$i]->specie->image->url : null;
                    $user->pets[$i]['images'] = $pet[$i]->images;
                    $user->pets[$i]['specie'] = $pet[$i]->specie->name;
                    $user->pets[$i]['race'] = $pet[$i]->race->name;
                }

                return response()->json(['message' => 'Welcome again', 'user' => $user], 200);
            }
            return response()->json(['message' => 'User not found', 'data' => []], 404);
        } else {
            return response()->json(['message' => 'you are not authorized to view that profile', 'data' => []], 401);
        }

        return response()->json(['message' => 'Welcome', 'data' => []], 200);
    }

    function updateDataUser(Request $request)
    {

        $input = $request->all();
        $header = $request->header('Authorization');

        if ($header) {
            $user = User::where('api_token', $header)->first();
            if ($user) {

                $userFindE = User::where('email', $input['email'])
                    ->where('api_token', '!=', $header)
                    ->first();
                $userFindP = User::where('phone', $input['phone'])
                    ->where('api_token', '!=', $header)
                    ->first();
                if ($userFindE) return response()->json([
                    'type' => 'error',
                    'title' => __('Error in update user'),
                    'message' => __('Email is already registered')
                ], 301);
                try {
                    if (isset($input['user_id']))
                        validateUserID($input['user_id']);
                } catch (Exception $e) {
                    return response()->json([
                        'type' => 'error',
                        'title' => __('Error in update user'),
                        'message' => __('CI/RUC is invalid')
                    ], 401);
                }
                if ($userFindP) return response()->json([
                    'type' => 'error',
                    'title' => __('Error in update user'),
                    'message' => __('Phone is already registered')
                ], 301);
                if (isset($input['name']))  $input['name'] = ucwords(strtolower($input['name']));


                if ($user->email != $input['email']) {
                    $input['email_verified_at'] = null;
                }

                $input['email'] = strtolower($input['email']);

                try {
                    DB::beginTransaction();
                    $input['updated_at'] = now();
                    $input['id'] = $user->id;


                    $user->update($input);

                    $pet = $user->pets;
                    $user->canton;
                    $user->province;
                    $user->parish;

                    for ($i = 0; $i < count($pet); $i++) {
                        if ($user->pets[$i]->specie)
                            $user->pets[$i]['image_specie'] = $pet[$i]->specie->image ? $pet[$i]->specie->image->url : null;
                        $user->pets[$i]['images'] = $pet[$i]->images;
                        $user->pets[$i]['specie'] = $pet[$i]->specie->name;
                        $user->pets[$i]['race'] = $pet[$i]->race->name;
                    }

                    DB::commit();
                    return response()->json([
                        'type' => 'success',
                        'title' => __('Updated successfully'),
                        'message' => __('Updated user data'),
                        'user' => $user
                    ], 200);
                } catch (\Throwable $th) {
                    return response()->json([
                        'type' => 'error',
                        'title' => __('Something went wrong'),
                        'message' => __('There was an error on the server, please try again later')
                    ], 500);
                }
            } else {
                return response()->json([
                    'type' => 'error',
                    'title' => __('Something went wrong'),
                    'message' => __('User not found')
                ], 404);
            }
        } else {
            return response()->json([
                'type' => 'error',
                'title' => __('Something went wrong'),
                'message' => __('You are not authorized to update that profile')
            ], 401);
        }
    }

    public function VerifyEmail($api_token)
    {

        try {
            DB::beginTransaction();

            $user = User::where('api_token', $api_token)->first();
            if ($user->email_verified_at) return view('emails.accounts.index', ['message' => __('Your email is already verified')]);
            $data['email_verified_at'] = now();
            $user->update($data);
            DB::commit();

            return view('emails.accounts.index', ['message' => __('Account email is verified')]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return view('emails.accounts.index', ['message' => __('Something went wrong')]);
        }
    }


    public function updatedPassword(Request $request)
    {
        $input = $request->all();
        $header = $request->header('Authorization');

        if ($header) {
            $user = User::where('api_token', $header)->first();
            if ($user) {
                $passwordC = Hash::check($input['currentPassword'], $user->password);
                if ($passwordC) {
                    unset($input['currentPassword']);
                    $input['password'] =  Hash::make($input['password']);
                } else {
                    return response()->json([
                        'type' => 'error',
                        'title' => __('Error in update user'),
                        'message' => __('Current password is incorrect')
                    ], 404);
                }

                try {
                    DB::beginTransaction();
                    $input['updated_at'] = now();
                    $input['id'] = $user->id;

                    $user->update($input);

                    $pet = $user->pets;
                    $user->canton;
                    $user->province;
                    $user->parish;

                    for ($i = 0; $i < count($pet); $i++) {
                        if ($user->pets[$i]->specie)
                            $user->pets[$i]['image_specie'] = $pet[$i]->specie->image ? $pet[$i]->specie->image->url : null;
                        $user->pets[$i]['images'] = $pet[$i]->images;
                        $user->pets[$i]['specie'] = $pet[$i]->specie->name;
                        $user->pets[$i]['race'] = $pet[$i]->race->name;
                    }

                    DB::commit();
                    return response()->json([
                        'type' => 'success',
                        'title' => __('Updated successfully'),
                        'message' => __('Password updated successfully'),
                        'user' => $user
                    ], 200);
                } catch (\Throwable $th) {
                    return response()->json([
                        'type' => 'error',
                        'title' => __('Something went wrong'),
                        'message' => __('There was an error on the server, please try again later')
                    ], 500);
                }
            } else {
                return response()->json([
                    'type' => 'error',
                    'title' => __('Something went wrong'),
                    'message' => __('User not found')
                ], 404);
            }
        } else {
            return response()->json([
                'type' => 'error',
                'title' => __('Something went wrong'),
                'message' => __('You are not authorized to update that profile')
            ], 401);
        }
    }
}
