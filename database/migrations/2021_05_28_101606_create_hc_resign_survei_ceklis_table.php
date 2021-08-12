<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHcResignSurveiCeklisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_resign_survei_ceklis', function (Blueprint $table) {
            $table->id();
            $table->integer('master_karyawan_id')->nullable();
            $table->string('hc_resign_survei_nama_ceklis_id', 30)->nullable();
            $table->string('keterangan', 30)->nullable();
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
        Schema::dropIfExists('hc_resign_survei_ceklis');
    }
}
