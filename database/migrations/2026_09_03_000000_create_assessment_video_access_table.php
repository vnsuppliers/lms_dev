<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbl_assessment_video_access', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('assign_id');
            $table->unsignedBigInteger('course_id');
            $table->text('completed_video_ids')->nullable();
            $table->timestamp('granted_at')->nullable();
            $table->timestamp('consumed_at')->nullable();
            $table->unsignedBigInteger('assessment_id')->nullable();
            $table->timestamp('result_recorded_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'assign_id', 'consumed_at'], 'assessment_video_access_lookup');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_assessment_video_access');
    }
};
