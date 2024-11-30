<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Models\Pharmacy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterUserController extends Controller
{
    public function register(RegisterUserRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        // Hash password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create the user
        $user = User::create($validatedData);

        // If the type is 'pharmacy', create the related pharmacy record
        if ($validatedData['type'] === 'pharmacy') {
            $this->registerPharmacy($request, $user);
        }

        $token = $user->createToken('user', ['app:all'])->plainTextToken;

        // Login the user after registration
        Auth::login($user);

        return response()->json([
            'message' => 'Registered successfully.',
            'token' => $token,
            'user' => $user,
        ], 201);
    }

    protected function registerPharmacy(Request $request, User $user): void
    {
        $pharmacyData = $request->only(['pharmacy'])['pharmacy'];
        $pharmacyData['user_id'] = $user->id;


        $pharmacy = Pharmacy::create($pharmacyData);
        // Handle image upload
        if ($request->hasFile('pharmacy.logo')) {
            $pharmacy->addMediaFromRequest('pharmacy.logo')
                ->usingFileName(md5(Str::random(40)))
                ->toMediaCollection('logo');
        }
    }
}
