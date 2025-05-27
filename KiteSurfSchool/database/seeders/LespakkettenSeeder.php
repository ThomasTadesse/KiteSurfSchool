<?php

namespace Database\Seeders;

use App\Models\lespakketten;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LespakkettenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        lespakketten::create([
            'naam' => 'Privéles',
            'beschrijving' => 'Privéles 2,5 uur: € 175,- inclusief alle materialen, één persoon per les, 1 dagdeel',
            'prijs' => 175.00,
            'duur' => 2.5,
            'aantal_personen' => 1,
            'aantal_lessen' => 1,
            'aantal_dagdelen' => 1,
            'materiaal_inbegrepen' => true,
        ]);

        lespakketten::create([
            'naam' => 'Losse Duo Kiteles',
            'beschrijving' => 'Losse Duo Kiteles 3,5 uur: € 135,- per persoon inclusief alle materialen, maximaal 2 personen per les, 1 dagdeel',
            'prijs' => 135.00,
            'duur' => 3.5,
            'aantal_personen' => 2,
            'aantal_lessen' => 1,
            'aantal_dagdelen' => 1,
            'materiaal_inbegrepen' => true,
        ]);

        lespakketten::create([
            'naam' => 'Kitesurf Duo lespakket 3 lessen',
            'beschrijving' => 'Kitesurf Duo lespakket 3 lessen 10,5 uur: € 375,- per persoon inclusief materialen, maximaal 2 personen per les, 3 dagdelen',
            'prijs' => 375.00,
            'duur' => 10.5,
            'aantal_personen' => 2,
            'aantal_lessen' => 3,
            'aantal_dagdelen' => 3,
            'materiaal_inbegrepen' => true,
        ]);

        lespakketten::create([
            'naam' => 'Kitesurf Duo lespakket 5 lessen',
            'beschrijving' => 'Kitesurf Duo lespakket 5 lessen 17,5 uur: € 675,- per persoon inclusief materialen, maximaal 2 personen per les, 5 dagdelen',
            'prijs' => 675.00,
            'duur' => 17.5,
            'aantal_personen' => 2,
            'aantal_lessen' => 5,
            'aantal_dagdelen' => 5,
            'materiaal_inbegrepen' => true,
        ]);
    }
}
