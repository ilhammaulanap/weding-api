<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 
use Validator;

class LoginController extends Controller
{
    /**
     * index
     *
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user= User::where('email', $request->email)->first();
        
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'status'   => false,
                    'message' => 'These credentials do not match our records.'
                ], 404);
            }
            $user->tokens()->delete();
            $token = $user->createToken('ApiToken')->plainTextToken;
            $user['token'] = $token;
            $response = [
                'status'   => true,
                'message' => 'Login Success',
                'data'      => $user
            ];
        
        return response($response, 201);
    }
    
    /**
     * logout
     *
     * @return void
     */
    public function logout()
    {
        auth()->logout();
        return response()->json([
            'status'    => true
        ], 200);
    }
}
