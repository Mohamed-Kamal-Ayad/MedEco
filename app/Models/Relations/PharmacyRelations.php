<?php

namespace App\Models\Relations;

use App\Models\Branch;

trait PharmacyRelations
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function branches()
    {
        return $this->hasMany(Branch::class);
    }
}
