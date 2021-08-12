<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHcResignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_resigns', function (Blueprint $table) {
            $table->id();
            $table->integer('master_karyawan_id')->nullable();
            $table->integer('master_jabatan_id')->nullable();
            $table->string('lokasi_kerja', 30)->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->date('tanggal_keluar')->nullable();
            $table->string('alamat')->nullable();
            $table->string('telepon', 15)->nullable();
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
        Schema::dropIfExists('hc_resigns');
    }
}
