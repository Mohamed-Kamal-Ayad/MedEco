<?php

namespace App\Models\Concerns;

use App\Models\Customer;

trait BelongsToUser
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(Customer::class);
    }
}
