<?php

namespace App\Models\Relations;

use App\Models\Drug;

trait ComponentRelations
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function drugs()
    {
        return $this->belongsToMany(Drug::class);
    }
}
