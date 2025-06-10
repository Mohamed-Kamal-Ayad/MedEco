<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Medication extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'prescription_id',
        'medicine_name',
        'dosage',
        'frequency_type',
        'frequency_count',
        'specific_times',
        'specific_days',
        'duration_type',
        'duration_value',
        'start_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'specific_times' => 'json',
        'specific_days' => 'json',
        'start_date' => 'date',
        'frequency_count' => 'integer',
        'duration_value' => 'integer',
    ];

    /**
     * Get the prescription that owns the medication.
     */
    public function prescription(): BelongsTo
    {
        return $this->belongsTo(Prescription::class);
    }
}
