<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Throwable;
use Illuminate\Http\RedirectResponse;


class AuthController extends Controller
{
    public function showAdminLogin(): View
    {
        return view("auth/login");
    }

    public function showAdminRegister(): View
    {
        return view("auth/register");
    }

    public function register(Request $request)
    {
        
       try {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:64',
            'email' => 'required|string|email|max:64',
            'password' => 'required|string|min:4|max:255',
        ]);
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()], 400);
        }
        // return $request->username;
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['token' => $user->createToken('token')->plainTextToken], 200);
       } catch (\Throwable $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
                'error' => ['message' => $e->getMessage()]
            ], 500);;
       }
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);
    
            if($validator->fails()){
                return response()->json(['error' => $validator->errors()->all()], 400);
            }
    
            $user = User::where('email', $request->email)->first();
            // return $user;
            if($user){
                if(!Hash::check($request->password, $user->password)){
                    return response()->json(['error' => 'Unauthorized'], 400);
                }
            } else{
                return response()->json(['error' => 'User Not Found'], 404);
            }
            // $token = $user->createToken('token')->plainTextToken;
            return response()->json(['token' => $user->createToken('token')->plainTextToken]);
            // $request->session()->put("locale", $token);
            // return redirect()->route('home')->with('success', 'Login Successful!');
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
                'error' => ['message' => $e->getMessage()]
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();
            return response()->json(['message' => 'Logged out']);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
                'error' => ['message' => $e->getMessage()]
            ], 500);
        }
    }
}
