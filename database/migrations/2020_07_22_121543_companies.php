<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Companies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id('idCompanies');
            $table->string('RFC',15);
            $table->string('name');
            $table->string('phone1',10);
            $table->string('phone2',10);
            $table->string('email',50);
            $table->string('website',50);
            $table->string('name_contact',50);
            $table->foreignId('idUser')->references('id')->on('users');
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
        Schema::dropIfExists('companies');
    }
}
