<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    use HasFactory;

    public $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'date_of_birth',
        'emergency_contact_name',
        'emergency_contact_phone',
        'medical_notes',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'id';
    }
    
    // Add this method to help with route model binding debugging
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('id', $value)->firstOrFail();
    }

    /**
     * Get the user that owns the student profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The lespakketten that belong to the student.
     */
    public function lespakketten(): BelongsToMany
    {
        return $this->belongsToMany(lespakketten::class, 'student_lespakket')
                    ->withPivot('start_date', 'end_date', 'status', 'notes')
                    ->withTimestamps();
    }
}
