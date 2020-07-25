<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Units extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_units', function (Blueprint $table) {
            $table->id('idUnits');
            $table->foreignId('idcompany')->references('idCompanies')->on('companies');
            $table->string('RFC',10);
            $table->string('nameUnit');
            $table->string('phone1',10);
            $table->string('phone2',10);
            $table->string('address');
            $table->string('webSite');
            $table->string('nameContact');
            $table->time('cancelation_time_limit',0); 
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
        Schema::dropIfExists('business_units');
    }
}
