<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsCancelledAndCancellationReasonToCourseSectionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('course_sections', function (Blueprint $table) {
            $table->boolean('is_cancelled')->default(false); // Ajout de la colonne is_cancelled
            $table->string('cancellation_reason')->nullable(); // Ajout de la colonne cancellation_reason
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('course_sections', function (Blueprint $table) {
            $table->dropColumn('is_cancelled'); // Suppression de la colonne is_cancelled
            $table->dropColumn('cancellation_reason'); // Suppression de la colonne cancellation_reason
        });
    }
}