<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersUnits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_units', function (Blueprint $table) {
            $table->id('idUsersUnits');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('unit_id')->references('idUnits')->on('business_units');
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
        Schema::dropIfExists('users_units');
    }
}
