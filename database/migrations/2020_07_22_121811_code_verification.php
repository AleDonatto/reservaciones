<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CodeVerification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('code_verifications', function (Blueprint $table) {
            $table->id('idCode');
            $table->string('code_verification');
            $table->date('date_expiration');
            $table->foreignId('user')->references('id')->on('users');
            $table->foreignId('companies')->references('idCompanies')->on('companies');
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
        Schema::dropIfExists('code_verifications');
    }
}
