<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Order\StoreOrderRequest;
use App\Http\Requests\Api\User\Order\UpdateOrderRequest;
use App\Http\Resources\User\OrderResource;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = auth()->user()->orders()->with(['drug.pharmacyBranch.pharmacy'])->get();
        return OrderResource::collection($orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $order = Order::query()->create(['pharmacy_branch_id' => $request->pharmacy_branch_id, 'user_id' => auth()->id()]);
        $order->items()->createMany($request->drug_ids);
        return response()->json(['message' => 'تم إضافة الطلب بنجاح'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->validated());
        return response()->json(['message' => 'تم تعديل الطلب بنجاح']);
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
