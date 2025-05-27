<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lespakket extends Model
{
    use HasFactory;

    // Specify the correct table name
    protected $table = 'lespakkettens';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'instructor_id',
        'student_id',
        'naam',
        'beschrijving',
        'prijs',
        'duur',
        'niveau',
        'active',
        'aantal_personen',
        'aantal_lessen',
        'aantal_dagdelen',
        'materiaal_inbegrepen'
    ];

    /**
     * Get the bookings for this lespakket.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
