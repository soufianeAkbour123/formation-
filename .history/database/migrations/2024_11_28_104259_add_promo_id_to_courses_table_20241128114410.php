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
        Schema::table('courses', function (Blueprint $table) {
            // Ajouter la colonne promo_id
            $table->unsignedBigInteger('promo_id')->nullable()->after('id'); // Vous pouvez changer 'after' selon votre besoin
            // Définir la clé étrangère
            $table->foreign('promo_id')->references('id')->on('promos')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course', function (Blueprint $table) {
            //
        });
    }
};
