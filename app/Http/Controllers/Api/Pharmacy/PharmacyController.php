<?php

namespace App\Http\Controllers\Api\Pharmacy;

use App\Models\Pharmacy;
use Illuminate\Http\Request;
use App\Models\PharmacyBranch;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\PharmacyResource;

class PharmacyController extends Controller
{
    /**
     * Retrieve all pharmacies.
     *
     * @return JsonResponse
     */
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

    //make show

    public function show($id)
    {
        $pharmacy = Pharmacy::find($id);
        return $pharmacy
            ? PharmacyResource::make($pharmacy->load('branches'))
            : PharmacyResource::make($pharmacy)->additional(['message' => __('admin.not_found', ['attribute' => __('attributes.pharmacy')])]);
    }
}
