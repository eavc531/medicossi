<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_numbers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_banco');
            $table->string('number_account');
            $table->string('name_titular');
            $table->string('identification');
            $table->string('email')->nullable();
            $table->integer('promoter_id')->unsigned()->nullable();
            $table->foreign('promoter_id')->references('id')->on('promoters');
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
        Schema::dropIfExists('account_numbers');
    }
}
