<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('coupon_courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('coupon_id');
            $table->unsignedBigInteger('course_id');
            $table->timestamps();

            // Clés étrangères
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');

            // Pour éviter les doublons
            $table->unique(['coupon_id', 'course_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('coupon_courses');
    }
}