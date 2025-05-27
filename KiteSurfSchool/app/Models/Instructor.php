<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Instructor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialization',
        'bio',
        'certifications',
        'years_of_experience',
    ];

    /**
     * Get the user that owns the instructor profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the lespakketten taught by the instructor.
     */
    public function lespakketten(): BelongsToMany
    {
        return $this->belongsToMany(Lespakketten::class, 'instructor_lespakket')
                    ->withPivot('start_date', 'end_date')
                    ->withTimestamps();
    }
}
