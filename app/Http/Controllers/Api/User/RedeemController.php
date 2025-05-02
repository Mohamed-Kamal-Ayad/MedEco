<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\User\RedeemResource;
use App\Models\Redeem;
use Illuminate\Http\Request;

class RedeemController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $redeems = $user->redeems()->with('pharmacy')->get();

        return RedeemResource::collection($redeems);
    }

    public function show(Request $request, $id)
    {
        $user = $request->user();

        $redeem = $user->redeems()->with('pharmacy')->findOrFail($id);

        return new RedeemResource($redeem);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'points' => 'required|integer|min:1|max:' . $user->points,
        ], [
            'points.required' => 'The points are required.',
            'points.integer' => 'The points must be an integer.',
            'points.min' => 'The points must be at least 1.',
            'points.max' => 'The points may not be greater than your available points.',
        ]);

        $redeem = Redeem::create([
            'user_id' => $user->id,
            'pharmacy_id' => $request->pharmacy_id,
            'points' => $request->points,
            'is_approved' => false,
        ]);
        return new RedeemResource($redeem);
    }
}
