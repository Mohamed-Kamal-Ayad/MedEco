<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PrescriptionRequest;
use App\Http\Resources\PrescriptionResource;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the prescriptions.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = auth()->user()->prescriptions();

        // Handle search by patient name
        if ($request->has('search')) {
            $query->where('patient_name', 'like', '%' . $request->search . '%');
        }

        $prescriptions = $query->latest()->paginate();

        return PrescriptionResource::collection($prescriptions);
    }

    /**
     * Store a newly created prescription in storage.
     *
     * @param PrescriptionRequest $request
     * @return PrescriptionResource
     */
    public function store(PrescriptionRequest $request): PrescriptionResource
    {
        $prescription = auth()->user()->prescriptions()->create($request->validated());

        return new PrescriptionResource($prescription);
    }

    /**
     * Display the specified prescription.
     *
     * @param Prescription $prescription
     * @return PrescriptionResource
     */
    public function show(Prescription $prescription): PrescriptionResource
    {
        $this->authorize('view', $prescription);

        return new PrescriptionResource($prescription->load('medications'));
    }

    public function update(PrescriptionRequest $request, Prescription $prescription): PrescriptionResource
    {
        $this->authorize('update', $prescription);
        $prescription->update($request->validated());

        return new PrescriptionResource($prescription);
    }

    public function destroy(Prescription $prescription): Response
    {
        $this->authorize('delete', $prescription);

        $prescription->delete();

        return response()->noContent();
    }
}
