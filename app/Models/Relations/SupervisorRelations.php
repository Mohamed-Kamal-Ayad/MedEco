<?php

namespace App\Models\Relations;

use App\Models\Customer;

trait SupervisorRelations
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
