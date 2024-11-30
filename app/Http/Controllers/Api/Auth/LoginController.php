<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Resources\PharmacyResource;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        // Validate request input
        $validated = $request->validated();

        // Find the user by email and type
        $user = User::where('email', $validated['email'])
            ->where('type', $validated['type'])
            ->first();
        // Check if user exists and password is correct
        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials or user type.',
            ], 401);
        }

        // Generate token for the authenticated user
        $token = $user->createToken($validated['type'], ['app:all'])->plainTextToken;

        // Login the user
        Auth::login($user);
        if ($user->type === 'user') {
            return response()->json([
                'user' => new UserResource($user),
                'token' => $token,
                'message' => 'Login successful.',
            ]);
        } elseif ($user->type === 'pharmacy') {
            return response()->json([
                'user' => null,
                'pharmacy' => new PharmacyResource($user->pharmacy),
                'token' => $token,
                'message' => 'Login successful.',
            ]);
        }
    }
}
