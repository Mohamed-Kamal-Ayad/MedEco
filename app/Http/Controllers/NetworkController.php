<?php

namespace App\Http\Controllers;

use App\Http\Resources\PharmacyBranchResource;
use App\Http\Resources\PharmacyResource;
use App\Models\Network;
use Illuminate\Http\Request;

class NetworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reqs = Network::query()->where('receiver_id', null)
            ->where('is_approved', false)
            ->whereRelation('sender.pharmacy', 'user_id', '!=', auth()->id())
            ->get();
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

    public function getMyRequests()
    {
        $reqs = Network::query()
            ->whereRelation('sender.pharmacy', 'user_id', auth()->id())
            ->get();
        $res = $reqs?->map(function ($req) {
            if ($req->is_approved) {
                return [
                    'id' => $req->id,
                    'description' => $req->description,
                    'is_approved' => $req->is_approved,
                    'receiver' => [
                        'pharmacy' => PharmacyResource::make($req->receiver->pharmacy),
                        'pharmacy_branch' => PharmacyBranchResource::make($req->receiver),
                    ]
                ];
            } else {
                return [
                    'id' => $req->id,
                    'description' => $req->description,
                    'is_approved' => $req->is_approved,
                ];
            }
        });
        return response()->json($res);
    }
    public function getMyApprovedRequests()
    {
        $reqs = Network::query()
            ->whereRelation('receiver.pharmacy', 'user_id', auth()->id())
            ->where('is_approved', true)
            ->get();
        $res = $reqs?->map(function ($req) {
            return [
                'id' => $req->id,
                'description' => $req->description,
                'is_approved' => $req->is_approved,
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
    public function store(Request $request)
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
    public function update(Request $request, Network $network)
    {
        $request->validate([
            'pharmacy_branch_id' => 'required|exists:pharmacy_branches,id',
        ]);
        $network->update([
            'is_approved' => 1,
            'receiver_id' => $request->pharmacy_branch_id,
        ]);

        return response()->json(['message' => 'Network updated successfully.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Network $network)
    {
        //
    }
}
