<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\User\RedeemResource;
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
            'pharmacy_id' => 'required|exists:pharmacies,id',
            'points' => 'required|integer|min:1',
        ]);

        $redeem = $user->redeems()->create($request->all());

        return new RedeemResource($redeem);
    }
}
