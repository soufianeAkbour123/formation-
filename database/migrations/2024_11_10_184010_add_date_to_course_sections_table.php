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
            $table->date('date')->nullable(); // Ajout du champ date
        });
    }
    
    public function down()
    {
        Schema::table('course_sections', function (Blueprint $table) {
            $table->dropColumn('date'); // Suppression du champ date
        });
    }
};