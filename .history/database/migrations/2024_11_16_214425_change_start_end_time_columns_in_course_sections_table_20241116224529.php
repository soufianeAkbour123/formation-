<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('course_sections', function (Blueprint $table) {
            $table->time('start_time')->nullable(); // Changement de dateTime à time
            $table->time('end_time')->nullable();   // Changement de dateTime à time
        });
    }
    
    public function down()
    {
        Schema::table('course_sections', function (Blueprint $table) {
            $table->dropColumn(['start_time', 'end_time']); // Pas de changement ici
        });
    }
};