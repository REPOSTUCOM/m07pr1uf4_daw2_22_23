<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signup(Request $request){
    $user = User::create([
    'name' => $request->input('name'),
    'email' => $request->input('email'),
    'password' => bcrypt($request->input('password')),
    ]);
    return response()->json(['message' => 'User signed up successfully'], 201);
    }
    public function login(Request $request){
            $validator = Validator::make($request->all(), [
            'email' => 'required | email',
            'password' => 'required',
            ]);
            
            if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
            }
            
            $user = User::where('email', $request->input('email'))->first();
            
            if (!$user) {
            return response()->json(['error' => 'Email is not registered'], 404);
            }
    
            if (!password_verify($request->input('password'), $user->password)) {
                return response()->json(['error' => 'Incorrect password'], 400);
            }
            
            $payload = [
            'iss' => config('app.url'),
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + (60 * 60 * 24),
            ];
            $jwt = JWT::encode($payload, config('app.key'), 'HS256');
            return response()->json(['token' => $jwt]);
    }
    public function logout(Request $request){
    }
}
