<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssistantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medico_id')->nullable();
            $table->string('identification');
            $table->string('name');
            $table->string('lastName');
            $table->string('phone1');
            $table->string('phone2')->nullable();
            $table->string('email');
            $table->string('dateActivation')->nullable();
            $table->string('status')->default('disabled');
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
        Schema::dropIfExists('assistants');
    }
}
