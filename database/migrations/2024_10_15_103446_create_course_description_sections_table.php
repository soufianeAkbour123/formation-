<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseDescriptionSectionsTable extends Migration
{
    public function up()
    {
        Schema::create('course_description_sections', function (Blueprint $table) {
            $table->id(); // Identifiant unique de la section
            $table->integer('course_id');// Référence à la table courses
            $table->string('title')->nullable();  // Champ pour le titre de la section
            $table->string('content')->nullable(); // Champ pour le contenu de la section
            $table->timestamps(); // Pour created_at et updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_description_sections');
    }
};
