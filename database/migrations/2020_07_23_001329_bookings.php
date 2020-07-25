<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Bookings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('idBooking');
            $table->foreignId('businessUnit')->references('idUnits')->on('business_units');
            $table->foreignId('table')->references('idTables')->on('tables_units');
            $table->foreignId('clients')->references('idCliets')->on('clients');
            $table->date('date');
            $table->time('hour',0);
            $table->integer('pax');
            $table->string('status',10);
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
        Schema::dropIfExists('bookings');
    }
}
