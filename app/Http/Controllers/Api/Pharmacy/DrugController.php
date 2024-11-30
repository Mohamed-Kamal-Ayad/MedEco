<?php

namespace App\Http\Controllers\Api\Pharmacy;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Pharmacy\Drug\StoreDrugRequest;
use App\Http\Requests\Api\Pharmacy\Drug\UpdateDrugRequest;
use App\Http\Resources\Pharmacy\DrugResource;
use App\Models\Drug;

class DrugController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drugs = Drug::with('drugType')->get();
        return DrugResource::collection($drugs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDrugRequest $request)
    {
        $data = $request->is_donated ? $request->safe()->merge(['price' => 0])->except('images') : $request->safe()->merge(['pharmacy_branch_id' => null])->except('images');

        $drug = auth()->user()->drugs()->create($data);

        if ($request->has('images'))
            $drug->addMultipleMediaFromRequest(['images'])
                ->each(function ($fileAdder) {
                    $fileAdder->usingFileName(md5(\Str::random(40)))->toMediaCollection('images');
                });

        return response()->json(['message' => 'تم إضافة الدواء بنجاح'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Drug $drug)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDrugRequest $request, Drug $drug)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Drug $drug)
    {
        //
    }
}
