<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tbl_employee_feedback_ratings', function (Blueprint $table) {
            if (!Schema::hasColumn('tbl_employee_feedback_ratings', 'suggestions')) {
                $table->text('suggestions')->nullable()->after('feedback');
            }
        });
    }

    public function down()
    {
        Schema::table('tbl_employee_feedback_ratings', function (Blueprint $table) {
            if (Schema::hasColumn('tbl_employee_feedback_ratings', 'suggestions')) {
                $table->dropColumn('suggestions');
            }
        });
    }
};
