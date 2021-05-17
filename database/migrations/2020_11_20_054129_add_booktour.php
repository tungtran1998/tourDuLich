<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBooktour extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('book_tours', function (Blueprint $table) {
             $table->double('single_room')->after('message');
             $table->double('single_room_price')->after('single_room');
             $table->double('price_kid')->after('single_room_price');
             $table->double('price_adult')->after('price_kid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
