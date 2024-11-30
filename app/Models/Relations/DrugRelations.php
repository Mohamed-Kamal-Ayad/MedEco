<?php

namespace App\Models\Relations;

use App\Models\Component;
use App\Models\DrugPharmacy;
use App\Models\DrugType;

trait DrugRelations
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(DrugType::class, 'type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pharmacies()
    {
        return $this->hasMany(DrugPharmacy::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function components()
    {
        return $this->belongsToMany(Component::class);
    }
}
