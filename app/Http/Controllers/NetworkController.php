<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNetworkRequest;
use App\Http\Requests\UpdateNetworkRequest;
use App\Http\Resources\PharmacyBranchResource;
use App\Http\Resources\PharmacyResource;
use App\Models\Network;

class NetworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reqs = Network::where('receiver_id', null)->where('is_approved', false)->get();
        $res = $reqs?->map(function ($req) {
            return [
                'id' => $req->id,
                'description' => $req->description,
                'sender' => [
                    'pharmacy' => PharmacyResource::make($req->sender->pharmacy),
                    'pharmacy_branch' => PharmacyBranchResource::make($req->sender),
                ]
            ];
        });
        return response()->json($res);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNetworkRequest $request)
    {
        $request->validate([
            'description' => 'required|string',
            'pharmacy_branch_id' => 'required|exists:pharmacy_branches,id',
        ]);

        Network::create([
            'description' => $request->description,
            'sender_id' => $request->pharmacy_branch_id,
            'receiver_id' => null,
            'is_approved' => false,
        ]);

        return response()->json(['message' => 'Network created successfully.'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Network $network)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNetworkRequest $request, Network $network)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Network $network)
    {
        //
    }
}
