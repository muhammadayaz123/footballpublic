<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->increments('id')->unsigned(false);
            $table->string('uuid')->unique()->nullable();

            $table->integer('player_id')->nullable();
            $table->foreign('player_id')->references('id')->on('profiles')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('host_id')->nullable();
            $table->foreign('host_id')->references('id')->on('profiles')->onUpdate('cascade')->onDelete('cascade');

            $table->dateTime('date_time')->nullable();
            $table->double('price')->nullable();
            $table->integer('commission')->nullable();
            $table->double('total')->nullable();
            $table->boolean('is_attended')->nullable();
            $table->boolean('is_payed')->default('0');
            $table->enum('status',['pending','accepted','rejected','other'])->nullable();

            $table->integer('stadium_id')->nullable();
            $table->foreign('stadium_id')->references('id')->on('stadia')->onUpdate('cascade')->onDelete('cascade');


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
        Schema::dropIfExists('invitations');
    }
}
