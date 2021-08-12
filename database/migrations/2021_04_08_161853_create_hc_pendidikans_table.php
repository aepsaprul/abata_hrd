<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHcPendidikansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_pendidikans', function (Blueprint $table) {
            $table->id();
            $table->integer('tingkat')->nullable();
            $table->string('nama', 50)->nullable();
            $table->string('kota', 30)->nullable();
            $table->string('jurusan', 30)->nullable();
            $table->date('tahun_masuk')->nullable();
            $table->date('tahun_lulus')->nullable();
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
        Schema::dropIfExists('hc_pendidikans');
    }
}
