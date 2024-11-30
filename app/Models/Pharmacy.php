<?php

namespace App\Models;

use App\Http\Filters\Filterable;
use App\Http\Filters\PharmacyFilter;
use App\Models\Concerns\BelongsToUser;
use App\Models\Relations\PharmacyRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Pharmacy extends Model implements HasMedia
{
    use Filterable;
    use HasFactory;
    use InteractsWithMedia;
    use BelongsToUser;
    use PharmacyRelations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'hotline',
        'is_active',
        'user_id',
        'is_accept_expired'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * The model filter name.
     *
     * @var string
     */
    protected $filter = PharmacyFilter::class;

    /**
     * Determine whether the pharamcy is active or not.
     *
     * @return bool
     */
    public function isActive()
    {
        return !!$this->is_active;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function branches()
    {
        return $this->hasMany(PharmacyBranch::class);
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')
            ->singleFile();
    }

}


    


