<?php

namespace App\Http\Controllers\Api\Pharmacy;

use App\Http\Controllers\Controller;
use App\Models\Redeem;
use Illuminate\Http\Request;

class RedeemController extends Controller
{
    public function index(Request $request)
    {
        // Implement the logic to retrieve and return all redemptions for the pharmacy
        // You can use the pharmacy ID from the authenticated user
        $pharmacy = $request->user()->pharmacy;

        // Assuming you have a relationship set up in the Pharmacy model
        $redeems = $pharmacy->redeems()->with('user')->get();

        return response()->json(['data' => $redeems]);
    }

    public function show(Request $request, $id)
    {
        $redeem = Redeem::where(function ($query) use ($request) {
            $query->where('is_approved', false)
                ->orWhere('pharmacy_id', $request->user()->pharmacy->id);
        })->with('user')->findOrFail($id);


        return response()->json($redeem);
    }

    public function update(Request $request, $id)
    {
        // Implement the logic to update a specific redemption by ID for the pharmacy
        $pharmacy = $request->user()->pharmacy;

        // Assuming you have a relationship set up in the Pharmacy model
        $redeem = Redeem::findOrFail($id);

        if ($redeem->pharmacy_id) {
            return response()->json(['error' => 'The redemption has already been approved.'], 422);
        }

        if ($redeem->user->points < $redeem->points) {
            return response()->json(['error' => 'The user does not have enough points.'], 422);
        }

        $redeem->update([
            'pharmacy_id' => $pharmacy->id,
            'is_approved' => true,
        ]);

        return response()->json($redeem);
    }
}
