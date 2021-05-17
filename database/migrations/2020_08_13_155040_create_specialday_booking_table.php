<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialdayBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialday_booking', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('booking_id')->unsigned();
            $table->foreign('booking_id')->references('id')->on('bookings')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->integer('specialday_id')->unsigned();
            $table->foreign('specialday_id')->references('id')->on('price_manager')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->double('percent');
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
        Schema::dropIfExists('specialday_booking');
    }
}
