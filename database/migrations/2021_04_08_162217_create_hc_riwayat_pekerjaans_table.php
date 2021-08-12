<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHcRiwayatPekerjaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_riwayat_pekerjaans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan', 50)->nullable();
            $table->string('jenis_industri', 50)->nullable();
            $table->string('jabatan_awal', 50)->nullable();
            $table->string('jabatan_akhir', 50)->nullable();
            $table->date('awal_bekerja')->nullable();
            $table->date('akhir_bekerja')->nullable();
            $table->integer('gaji_awal')->nullable();
            $table->integer('gaji_akhir')->nullable();
            $table->string('nama_atasan', 50)->nullable();
            $table->string('alasan_berhenti', 100)->nullable();
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
        Schema::dropIfExists('hc_riwayat_pekerjaans');
    }
}
