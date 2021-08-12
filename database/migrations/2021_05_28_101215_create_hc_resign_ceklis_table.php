<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHcResignCeklisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_resign_ceklis', function (Blueprint $table) {
            $table->id();
            $table->integer('master_karyawan_id')->nullable();
            $table->string('nama_ceklis', 100)->nullable();
            $table->string('keterangan', 10)->nullable();
            $table->date('tanggal_selesai')->nullable();
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
        Schema::dropIfExists('hc_resign_ceklis');
    }
}
