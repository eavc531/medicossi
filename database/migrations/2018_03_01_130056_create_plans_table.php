<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('applicable');
            $table->string('porcentage')->default(0);
            $table->float('price1')->default(0);
            $table->float('price2')->default(0);
            $table->float('price3')->default(0);
            $table->float('porcentage_price1')->default(0);
            $table->float('porcentage_price2')->default(0);
            $table->float('porcentage_price3')->default(0);
            $table->string('options')->nullable();
            $table->string('modules',100)->nullable();
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
        Schema::dropIfExists('plans');
    }
}
