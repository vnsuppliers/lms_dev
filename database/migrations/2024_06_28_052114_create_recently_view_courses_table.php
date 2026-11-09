<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecentlyViewCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('tbl_recently_view_courses', function (Blueprint $table) {
            $table->id();
            $table->integer('assign_id'); 
            $table->integer('user_id'); 
            $table->dateTime('view_time')->nullable(); 
            $table->boolean('status')->default(true);  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_recently_view_courses');
    }
}
