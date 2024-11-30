<?php

namespace App\Models\Relations;

use App\Models\DrugPharmacy;
use App\Models\Pharmacy;

trait BranchRelations
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function drugs()
    {
        return $this->hasMany(DrugPharmacy::class);
    }
}
