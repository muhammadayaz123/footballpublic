<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->increments('id')->unsigned(false);
            $table->string('uuid')->unique()->nullable();

            $table->integer('sender_id')->nullable();
            $table->foreign('sender_id')->references('id')->on('profiles')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('card_id')->nullable();

            $table->integer('receiver_id')->nullable();
            $table->foreign('receiver_id')->references('id')->on('profiles')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('invitation_id')->nullable();
            $table->foreign('invitation_id')->references('id')->on('invitations')->onUpdate('cascade')->onDelete('cascade');

            $table->double('price',20,6)->default(0.0);
            $table->double('tax',20,6)->default(0.0);



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
        Schema::dropIfExists('payment_histories');
    }
}
