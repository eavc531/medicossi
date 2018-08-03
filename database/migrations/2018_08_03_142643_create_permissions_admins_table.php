<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions_admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('options')->nullable();
            $table->string('admin_create')->nullable();
            $table->string('admin_edit')->nullable();
            $table->string('admin_delete')->nullable();

            $table->string('promoter_create')->nullable();
            $table->string('promoter_check_deposit')->nullable();
            $table->string('promoter_desactivate')->nullable();

            $table->string('patients_desactivate')->nullable();

            $table->string('plans_set_price')->nullable();



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
        Schema::dropIfExists('permissions_admins');
    }
}
