<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_of_birth',
        'emergency_contact_name',
        'emergency_contact_phone',
        'medical_notes',
    ];

    /**
     * Get the user that owns the student profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the lespakketten for the student.
     */
    public function lespakketten(): BelongsToMany
    {
        return $this->belongsToMany(Lespakket::class, 'student_lespakket')
                    ->withPivot(['start_date', 'end_date', 'status', 'notes'])
                    ->withTimestamps();
    }
}
