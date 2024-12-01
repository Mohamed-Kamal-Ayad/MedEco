<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'order_number';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function drug()
    {
        return $this->belongsTo(Drug::class);
    }

    public function pharmacyBranch()
    {
        return $this->belongsTo(PharmacyBranch::class);
    }

    public function items()
    {
        return $this->hasMany(OrdertItem::class);
    }


    public function scopeCompleted($query)
    {
        return $query->where('is_completed', true);
    }

    public function scopeNotCompleted($query)
    {
        return $query->where('is_completed', false);
    }


    public function getTotalAttribute()
    {
        return $this->items->sum(function ($item) {
            return $item->quantity * $item->drug->points;
        });
    }

    protected function orderNumber(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Order::count() > 0
                ? "ORD-" . Str::padLeft(Order::count() + 1, Str::length(Order::first()->order_code) - 3, '0')
                : 'ORD-0001'
        );
    }
}
