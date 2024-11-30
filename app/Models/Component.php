<?php

namespace App\Models;

use App\Models\Relations\ComponentRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable as TranslatableTrait;
use Astrotomic\Translatable\Contracts\Translatable;

class Component extends Model implements Translatable
{
    use HasFactory;
    use TranslatableTrait;
    use ComponentRelations;

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = [
        'name',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'translations',
    ];
}
