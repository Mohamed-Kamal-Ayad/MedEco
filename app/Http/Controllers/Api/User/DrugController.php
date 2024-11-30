<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Drug\StoreDrugRequest;
use App\Http\Requests\Api\User\Drug\UpdateDrugRequest;
use App\Http\Resources\User\DrugResource;
use App\Models\Drug;
use Illuminate\Support\Str;

class DrugController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->has('my_drugs') && request()->my_drugs == 'true') {
            $drugs = auth()->user()->drugs()->with(['drugType', 'pharmacyBranch.pharmacy'])->get();
        } else {
            $drugs = Drug::query()
                ->filter(request(['search']))
                ->when(request()->has('is_donated') && request()->is_donated == 'true', function ($query) {
                    $query->where('is_donated', 1);
                })
                ->where('pharmacy_branch_id', '!=', null)
                ->whereDoesntHave('order')
                ->with(['drugType', 'pharmacyBranch.pharmacy'])->get();
        }
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
                    $fileAdder->usingFileName(md5(Str::random(40)))->toMediaCollection('images');
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
