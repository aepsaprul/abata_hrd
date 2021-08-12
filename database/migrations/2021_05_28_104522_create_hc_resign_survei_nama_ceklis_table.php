<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHcResignSurveiNamaCeklisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_resign_survei_nama_ceklis', function (Blueprint $table) {
            $table->id();
            $table->string('group_nama_ceklis')->nullable();
            $table->text('nama_ceklis')->nullable();
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
        Schema::dropIfExists('hc_resign_survei_nama_ceklis');
    }
}
