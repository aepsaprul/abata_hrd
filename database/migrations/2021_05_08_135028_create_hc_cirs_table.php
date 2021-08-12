<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHcCirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_cirs', function (Blueprint $table) {
            $table->id();
            $table->integer('master_karyawan_id')->nullable();
            $table->string('jenis', 10)->nullable();
            $table->string('file_1', 50)->nullable();
            $table->string('file_2', 50)->nullable();
            $table->string('file_3', 50)->nullable();
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
        Schema::dropIfExists('hc_cirs');
    }
}
