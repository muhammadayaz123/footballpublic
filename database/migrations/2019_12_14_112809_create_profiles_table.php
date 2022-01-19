<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id')->unsigned(false);
            $table->string('uuid')->unique()->nullable();

            $table->integer('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->enum('profile_type', ['player', 'manger'])->default(null);
            $table->enum('position', ['goalkeeper', 'defender', 'midfielder', 'forward'])->default(null);

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('username')->unique()->nullable();
            $table->longText('bio')->nullable();
            $table->text('favorite_club')->nullable();
            $table->text('profile_image')->nullable();
            $table->date('dob')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();

            $table->double('price')->nullable();

            $table->double('ratings')->nullable();
            $table->double('ratings_count')->nullable();
            $table->double('rating')->default(0);

            $table->integer('missed_matches')->nullable();
            $table->integer('played_matches')->nullable();

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
        Schema::dropIfExists('profiles');
    }
}
