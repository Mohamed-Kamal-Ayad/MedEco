<?php

namespace App\Models\Relations;

use App\Models\DrugPharmacy;

trait UserRelations
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function drugs()
    {
        return $this->hasMany(DrugPharmacy::class);
    }
}
