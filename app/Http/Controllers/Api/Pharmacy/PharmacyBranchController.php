<?php

namespace App\Http\Controllers\Api\Pharmacy;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PharmacyBranch;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BranchRequest;

class PharmacyBranchController extends Controller
{
    public function index(Request $request): JsonResponse
    {

        $branches = PharmacyBranch::query()
            ->with('pharmacy')
            ->when($request->has('is_accept_expired') && $request->is_accept_expired == 'true', function ($query) use ($request) {
                $query->whereHas('pharmacy', function ($query) use ($request) {
                    $query->where('is_accept_expired', $request->is_accept_expired);
                });
            })
            ->when($request->has('my_branches') && $request->my_branches == 'true', function ($query) {
                $query->where('pharmacy_id', auth()->user()->pharmacy->id);
            })
            ->get();


        return response()->json([
            'data' => $branches,
        ]);
    }

    public function show() {}

    public function store(BranchRequest $request): JsonResponse
    {
        // Validate the incoming request data
        $validatedData = $request->validated();

        // Create the pharmacy branch
        $branch = PharmacyBranch::create($validatedData);

        // Return the response
        return response()->json([
            'message' => 'Pharmacy branch created successfully.',
            'data' => $branch,
        ], 201);
    }
}
