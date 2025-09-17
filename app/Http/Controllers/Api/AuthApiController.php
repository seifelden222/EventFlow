<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function Register(RegisterRequest $registerRequest)
    {
        try {
            $validatedData = $registerRequest->validated();
            if ($validatedData['password']) {
                $validatedData['password'] = Hash::make($validatedData['password']);
                $user = User::create($validatedData);
                Auth::login($user);
                return response()->json([
                    'message' => 'User registered successfully',
                    'user' => $user
                ], 201);
            } else {
                return response()->json([
                    'message' => 'Password is required'
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Registration failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
    {

        try {
            $user = User::where('email', $request->email)->first();

            if (! $user || ! Hash::check($request->password, $user->password)) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }
            

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'user' => $request->user(),
                'token' => $token
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Login failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            if (!$request->user())        return response()->json(['message' => 'Not authenticated.'], 401);



            $request->user()->tokens()->delete();
            return response()->json([
                'message' => 'Logout successful'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Logout failed',
                'error' => $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred during logout',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
