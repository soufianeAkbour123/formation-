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
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('subcategory_id');
            $table->dropColumn('resources');
        });
    }
    
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->text('resources')->nullable();
        });
    }
    
};
