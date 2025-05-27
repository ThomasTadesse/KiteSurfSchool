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
        // Check if the table exists
        if (Schema::hasTable('student_lespakket')) {
            // Check if the column exists before trying to rename it
            if (Schema::hasColumn('student_lespakket', 'lespakket_id') && !Schema::hasColumn('student_lespakket', 'lespakketten_id')) {
                Schema::table('student_lespakket', function (Blueprint $table) {
                    // Rename the column to match what Laravel is expecting
                    $table->renameColumn('lespakket_id', 'lespakketten_id');
                });
            }
            
            // If neither column exists, add the correct one
            if (!Schema::hasColumn('student_lespakket', 'lespakket_id') && !Schema::hasColumn('student_lespakket', 'lespakketten_id')) {
                Schema::table('student_lespakket', function (Blueprint $table) {
                    $table->unsignedBigInteger('lespakketten_id');
                    $table->foreign('lespakketten_id')
                          ->references('id')
                          ->on('lespakkettens')
                          ->onDelete('cascade');
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('student_lespakket') && Schema::hasColumn('student_lespakket', 'lespakketten_id')) {
            Schema::table('student_lespakket', function (Blueprint $table) {
                $table->renameColumn('lespakketten_id', 'lespakket_id');
            });
        }
    }
};
