<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHcTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_trainings', function (Blueprint $table) {
            $table->id();
            $table->string('kategori', 50)->nullable();
            $table->string('judul', 100)->nullable();
            $table->integer('master_divisi_id')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('durasi', 50)->nullable();
            $table->string('peserta', 30)->nullable();
            $table->string('tempat', 50)->nullable();
            $table->string('goal', 100)->nullable();
            $table->string('pengisi', 50)->nullable();
            $table->string('jenis', 10)->nullable();
            $table->string('hasil', 100)->nullable();
            $table->string('status', 30)->nullable();
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
        Schema::dropIfExists('hc_trainings');
    }
}
