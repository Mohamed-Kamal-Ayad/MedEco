<?php

namespace App\Models\Relations;

use App\Models\DrugPharmacy;
use App\Models\User;

trait OrderRelations
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function drugPharmacy()
    {
        return $this->belongsTo(DrugPharmacy::class);
    }
}
