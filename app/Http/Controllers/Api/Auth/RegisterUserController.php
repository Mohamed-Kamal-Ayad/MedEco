<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Models\Pharmacy;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Resources\PharmacyResource;
use App\Http\Requests\Api\RegisterUserRequest;

class RegisterUserController extends Controller
{
    public function register(RegisterUserRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);

        if ($validatedData['type'] === 'pharmacy') {
            $this->registerPharmacy($request, $user);
        }

        $token = $user->createToken('user', ['app:all'])->plainTextToken;

        Auth::login($user);

        if ($validatedData['type'] === 'pharmacy') {
            return response()->json([
                'user' => null,
                'pharmacy' => new PharmacyResource($user->pharmacy),
                'token' => $token,
                'message' => 'Login successful.',
            ]);
        }
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
