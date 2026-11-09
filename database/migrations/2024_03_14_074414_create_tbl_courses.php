<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCourses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_name'); 
            $table->string('category_id'); 
            $table->string('subcategory_id')->nullable();
            $table->text('description')->nullable(); 
            $table->boolean('active')->default(false); 
            $table->boolean('hide_from_catalog')->default(true); 
            $table->string('course_code'); 
            $table->string('intro_video')->nullable(); 
            $table->string('capacity')->nullable();
            $table->dateTime('start_date')->nullable(); 
            $table->dateTime('expiration_date')->nullable(); 
            $table->boolean('retain_access')->default(false); 
            $table->string('certificate')->nullable(); 
            $table->integer('level')->nullable(); 
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
        Schema::dropIfExists('tbl_courses');
    }
}
