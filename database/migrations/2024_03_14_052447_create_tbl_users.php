<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('username');
            $table->string('password');
            $table->text('description');
            $table->string('user_name');
            $table->string('pass_word');
            $table->enum('user_type', ['Admin-Type', 'User-Type'])->default('User-Type');
            $table->string('time_zone')->nullable();
            $table->string('language')->nullable();
            $table->boolean('active')->default(true);
            $table->dateTime('deactivation_date')->nullable();
            $table->boolean('exclude_from_emails')->default(false);
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
        Schema::dropIfExists('tbl_users');
    }
}
