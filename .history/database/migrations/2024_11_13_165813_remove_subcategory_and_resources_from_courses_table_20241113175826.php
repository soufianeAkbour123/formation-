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
