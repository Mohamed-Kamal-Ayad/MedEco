<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MedicationRequest;
use App\Http\Resources\MedicationResource;
use App\Models\Medication;
use App\Models\Prescription;
use Illuminate\Http\Response;

class MedicationController extends Controller
{
    /**
     * Store a newly created medication in storage.
     *
     * @param MedicationRequest $request
     * @param Prescription $prescription
     * @return MedicationResource
     */
    public function store(MedicationRequest $request, Prescription $prescription): MedicationResource
    {
        $this->authorize('update', $prescription);

        $medication = $prescription->medications()->create($request->validated());

        return new MedicationResource($medication);
    }

    /**
     * Update the specified medication in storage.
     *
     * @param MedicationRequest $request
     * @param Medication $medication
     * @return MedicationResource
     */
    public function update(MedicationRequest $request, Medication $medication): MedicationResource
    {
        $this->authorize('update', $medication->prescription);

        $medication->update($request->validated());

        return new MedicationResource($medication);
    }

    /**
     * Remove the specified medication from storage.
     *
     * @param Medication $medication
     * @return Response
     */
    public function destroy(Medication $medication): Response
    {
        $this->authorize('update', $medication->prescription);

        $medication->delete();

        return response()->noContent();
    }
}