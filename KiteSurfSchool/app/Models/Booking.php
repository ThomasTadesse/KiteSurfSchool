<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;
    
    protected $table = 'bookings';

    protected $fillable = [
        'user_id',
        'lespakket_id',
        'datum',
        'status',
        'payment_status',
        'invoice_number',
        'notes',
    ];

    protected $casts = [
        'datum' => 'datetime',
    ];

    /**
     * Get the user associated with the booking
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the lespakket (course package) associated with the booking
     */
    public function lespakket(): BelongsTo
    {
        return $this->belongsTo(Lespakket::class, 'lespakket_id');
    }
}
