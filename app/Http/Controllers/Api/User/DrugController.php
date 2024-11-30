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
        $drugs = Drug::with('drugType')->get();
        return DrugResource::collection($drugs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDrugRequest $request) {}

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
