<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Exécuter les modifications.
     */
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->integer('category_id')->nullable(false)->change();
            $table->integer('subcategory_id')->nullable(false)->change();
            $table->integer('instructor_id')->nullable(false)->change();
            $table->string('course_image')->nullable(false)->change();
            $table->text('course_title')->nullable(false)->change();
            $table->text('course_name')->nullable(false)->change();
            $table->string('course_name_slug')->nullable(false)->change();
            $table->longText('description')->nullable(false)->change();
            $table->string('video')->nullable(false)->change();
            $table->string('label')->nullable(false)->change();
            $table->string('duration')->nullable(false)->change();
            $table->date('date_debut')->nullable(false)->change();
            $table->date('date_fin')->nullable(false)->change();
            $table->string('resources')->nullable(false)->change();
            $table->string('certificate')->nullable(false)->change();
            $table->integer('selling_price')->nullable(false)->change();
            $table->integer('discount_price')->nullable(false)->change();
            $table->text('prerequisites')->nullable(false)->change();
            $table->string('bestseller')->nullable(false)->change();
            $table->string('featured')->nullable(false)->change();
            $table->string('highestrated')->nullable(false)->change();
            $table->tinyInteger('status')->default(0)->nullable(false)->change();
            $table->integer('nombre_maxDInscrit')->nullable(false)->change();
            $table->string('type_formation')->nullable(false)->change();
            $table->string('programme_file')->nullable(false)->change();
        });
    }

    /**
     * Inverser les modifications.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->integer('category_id')->nullable()->change();
            $table->integer('subcategory_id')->nullable()->change();
            $table->integer('instructor_id')->nullable()->change();
            $table->string('course_image')->nullable()->change();
            $table->text('course_title')->nullable()->change();
            $table->text('course_name')->nullable()->change();
            $table->string('course_name_slug')->nullable()->change();
            $table->longText('description')->nullable()->change();
            $table->string('video')->nullable()->change();
            $table->string('label')->nullable()->change();
            $table->string('duration')->nullable()->change();
            $table->date('date_debut')->nullable()->change();
            $table->date('date_fin')->nullable()->change();
            $table->string('resources');
            $table->string('certificate').
            $table->integer('selling_price')->nullable()->change();
            $table->integer('discount_price')->nullable()->change();
            $table->text('prerequisites')->nullable()->change();
            $table->string('bestseller')->nullable()->change();
            $table->string('featured')->nullable()->change();
            $table->string('highestrated')->nullable()->change();
            $table->tinyInteger('status')->default(0)->nullable()->change();
            $table->integer('nombre_maxDInscrit')->nullable()->change();
            $table->string('type_formation')->nullable()->change();
            $table->string('programme_file')->nullable()->change();
        });
    }
};
