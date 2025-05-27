<?php

namespace App\Models;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
     * Get the students associated with the lespakket.
     */
    public function students()
    {
        return $this->hasMany(Student::class, 'student_lespakket')
                    ->withPivot(['start_date', 'end_date', 'status', 'notes'])
                    ->withTimestamps();
    }
}
