<?php

namespace App\Models;

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
}
