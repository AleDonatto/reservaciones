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
            $table->foreignId('businessUnit_id')->references('idUnits')->on('business_units');
            $table->foreignId('table_id')->references('idTables')->on('tables_units');
            $table->foreignId('usuario_id')->references('id')->on('users');
            $table->date('bdate');
            $table->time('bhour',0);
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
