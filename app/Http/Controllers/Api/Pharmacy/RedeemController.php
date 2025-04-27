<?php

namespace App\Http\Controllers\Api\Pharmacy;

use App\Http\Controllers\Controller;
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

        return response()->json($redeems);
    }

    public function show(Request $request, $id)
    {
        // Implement the logic to retrieve and return a specific redemption by ID for the pharmacy
        $pharmacy = $request->user()->pharmacy;

        // Assuming you have a relationship set up in the Pharmacy model
        $redeem = $pharmacy->redeems()->with('user')->findOrFail($id);

        return response()->json($redeem);
    }

    public function update(Request $request, $id)
    {
        // Implement the logic to update a specific redemption by ID for the pharmacy
        $pharmacy = $request->user()->pharmacy;

        // Assuming you have a relationship set up in the Pharmacy model
        $redeem = $pharmacy->redeems()->findOrFail($id);

        $redeem->update([
            'is_approved' => true,
        ]);

        return response()->json($redeem);
    }
}
