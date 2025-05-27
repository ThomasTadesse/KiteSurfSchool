<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lespakket extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lespakkettens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'naam',
        'beschrijving',
        'prijs',
        'duur',
        'niveau',
        'active',
        'aantal_personen',
        'aantal_lessen',
        'aantal_dagdelen',
        'materiaal_inbegrepen',
        'instructor_id',
        'student_id',
    ];

    /**
     * Get the instructor associated with the lespakket.
     */
    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    /**
     * Get the student associated with the lespakket.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the bookings for the lespakket.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'lespakket_id');
    }

    /**
     * The students that are enrolled in this lespakket.
     */
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_lespakket', 'lespakket_id', 'student_id')
                    ->withPivot('start_date', 'end_date', 'status', 'notes')
                    ->withTimestamps();
    }
}
