<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProvince extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tour_name');
            $table->string('departure_location');
            $table->string('destination');
            $table->integer('province_id')->unsigned();
            $table->foreign('province_id')->references('id')->on('provinces')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->double('price_adult');
            $table->double('price_kid');
            $table->double('single_room_price');
            $table->longText('tour_detail');
            $table->longText('tour_program');
            $table->string('tour_note');
            $table->integer('number_of_day');
            $table->time('departure_time');
            $table->date('departure_date');
            $table->date('return_date');
            $table->string('vehicle');
            $table->string('tour_image');
            $table->boolean('status')->default(0);
            $table->boolean('isdeleted')->default(0);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('tours');
    }
}
