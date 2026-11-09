<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tbl_employee_feedback_ratings', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id')->nullable()->after('feedback_rating_setting_id');
            $table->unsignedBigInteger('category_id')->nullable()->after('course_id');
            $table->unsignedTinyInteger('type')->nullable()->after('category_id');
        });
    }

    public function down()
    {
        Schema::table('tbl_employee_feedback_ratings', function (Blueprint $table) {
            $table->dropColumn(['course_id', 'category_id', 'type']);
        });
    }
};
