<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lespakket extends Model
{
    use HasFactory;

    protected $table = 'lespakketten';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'naam',
        'beschrijving',
        'prijs',
        'duur',
        'niveau',
        'active'
    ];

    /**
     * Get the bookings for this lespakket.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
