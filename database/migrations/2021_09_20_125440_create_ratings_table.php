<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->increments('id')->unsigned(false);
            $table->string('uuid')->unique();

            $table->integer('rater_id')->nullable();
            $table->foreign('rater_id')->references('id')->on('profiles')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('player_id')->nullable();
            $table->foreign('player_id')->references('id')->on('profiles')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('invitation_id')->nullable();
            $table->foreign('invitation_id')->references('id')->on('invitations')->onUpdate('cascade')->onDelete('cascade');

            $table->double('agility')->default(0);
            $table->double('stamina')->default(0);
            $table->double('strength')->default(0);
            $table->double('passes')->default(0);
            $table->double('shoots')->default(0);
            $table->double('appearance')->default(0);
            $table->double('pace')->default(0);
            $table->double('total_rating')->default(0);

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
        Schema::dropIfExists('ratings');
    }
}
