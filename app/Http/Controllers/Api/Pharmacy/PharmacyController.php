<?php

namespace App\Http\Controllers\Api\Pharmacy;

use App\Models\Pharmacy;
use App\Http\Controllers\Controller;
use App\Http\Resources\PharmacyResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    /**
     * Retrieve all pharmacies.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $pharmacies = Pharmacy::with('branches')->get();

        return response()->json([
            'data' => PharmacyResource::collection($pharmacies)
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
