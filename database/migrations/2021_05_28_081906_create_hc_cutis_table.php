<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHcCutisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_cutis', function (Blueprint $table) {
            $table->id();
            $table->integer('master_karyawan')->nullable();
            $table->integer('master_jabatan')->nullable();
            $table->string('telepon', 15)->nullable();
            $table->string('alamat')->nullable();
            $table->string('jenis', 10)->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_berakhir')->nullable();
            $table->integer('karyawan_pengganti')->nullable();
            $table->string('alasan', 100)->nullable();
            $table->date('tanggal_kerja')->nullable();
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
        Schema::dropIfExists('hc_cutis');
    }
}
