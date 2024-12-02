<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sender()
    {
        return $this->belongsTo(PharmacyBranch::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(PharmacyBranch::class, 'receiver_id');
    }

}
