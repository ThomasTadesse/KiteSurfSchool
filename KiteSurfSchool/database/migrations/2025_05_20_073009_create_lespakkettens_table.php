<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lespakkettens', function (Blueprint $table) {
            $table->id();
            $table->string('naam');
            $table->text('beschrijving');
            $table->decimal('prijs', 8, 2);
            $table->float('duur');
            $table->integer('aantal_personen');
            $table->integer('aantal_lessen')->default(1);
            $table->integer('aantal_dagdelen')->default(1);
            $table->boolean('materiaal_inbegrepen')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lespakkettens');
    }
};
