<?php

namespace App\Models;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class lespakketten extends Model
{
    /** @use HasFactory<\Database\Factories\LespakkettenFactory> */
    use HasFactory;
    
    protected $fillable = [
        'naam',
        'beschrijving',
        'prijs',
        'duur',
        'aantal_personen',
        'aantal_lessen',
        'aantal_dagdelen',
        'materiaal_inbegrepen'
    ];

    /**
     * The students that belong to the lespakket.
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'student_lespakket')
                    ->withPivot('start_date', 'end_date', 'status', 'notes')
                    ->withTimestamps();
    }
}
