<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
class JWTAuthController extends Controller
{
    // User Registration
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 400);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json($token, 201);
        // return response()->json(compact('user', 'token'), 201);
    }

    // User Login

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');


        // return response()->json(JWTAuth::attempt($credentials));
        try {
            if(!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }

            // Get user record
            $user = auth()->user();
            
            // Get the email & embed it to the token
            $token = JWTAuth::claims(['email' => $user->email])->fromUser($user);
            // $token = JWTAuth::fromUser($user);

            return response()->json(compact('token'));
        } catch(JWTException $e) {
            return response()->json(['error'=>$e->getMessage()],400);
        } catch (\Throwable $e) {
            return response()->json(['error'=>$e->getMessage()],400);
        }
    }
}
