<?php

namespace App\Http\Controllers\Api\Pharmacy;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Pharmacy\Order\StoreOrderRequest;
use App\Http\Requests\Api\Pharmacy\Order\UpdateOrderRequest;
use App\Http\Resources\Pharmacy\OrderResource;
use App\Models\Drug;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::query()->whereRelation('drug.pharmacyBranch.pharmacy', 'user_id', auth()->id())->with('drug.user')->get();
        return OrderResource::collection($orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $drug = Drug::where('id', $request->drug_id)->first();
        $drug->update(['pharmacy_branch_id' => $request->pharmacy_branch_id]);
        Order::create($request->safe()->merge(['user_id' => $drug->user_id])->only(['drug_id', 'user_id']));
        return response()->json(['message' => 'تم إضافة الطلب بنجاح'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json(['message' => 'تم حذف الطلب بنجاح']);
    }
}
