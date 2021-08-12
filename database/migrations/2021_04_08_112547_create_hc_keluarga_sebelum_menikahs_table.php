<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHcKeluargaSebelumMenikahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_keluarga_sebelum_menikahs', function (Blueprint $table) {
            $table->id();
            $table->string('hubungan', 30)->nullable();
            $table->string('nama', 50)->nullable();
            $table->integer('usia')->nullable();
            $table->string('pendidikan_terakhir', 10)->nullable();
            $table->string('pekerjaan_terakhir', 30)->nullable();
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
        Schema::dropIfExists('hc_keluarga_sebelum_menikahs');
    }
}
