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
            $table->boolean('is_rescheduled')->default(false);
            $table->unsignedBigInteger('original_section_id')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('course_sections', function (Blueprint $table) {
            $table->dropColumn(['is_rescheduled', 'original_section_id']);
        });
    }
    
};
