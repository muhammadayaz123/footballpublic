<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned(false);
            $table->string('uuid')->unique()->nullable();

            $table->string('email')->unique();
            $table->string('phone_code')->nullable();
            $table->string('phone_number')->unique()->nullable();
            $table->string('password')->nullable();

            $table->integer('profile_id')->nullable();
            $table->enum('position', ['goalkeeper', 'defender', 'midfielder', 'forward'])->default(null);


            $table->enum('user_type', ['user', 'admin'])->default('user');

            $table->timestamp('phone_verified_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();

            $table->boolean('is_social')->default(false);
            $table->string('social_id')->nullable();
            $table->string('social_email')->nullable();
            $table->enum('social_type', ['facebook', 'google', 'twitter', 'apple'])->nullable();
            $table->boolean('is_social_password_updated')->default(false);

            $table->boolean('is_online')->default(false);

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
