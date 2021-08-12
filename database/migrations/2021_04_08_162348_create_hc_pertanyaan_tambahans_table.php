<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHcPertanyaanTambahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_pertanyaan_tambahans', function (Blueprint $table) {
            $table->id();
            $table->integer('master_pertanyaan_tambahan_id')->nullable();
            $table->string('jawaban', 10)->nullable();
            $table->text('uraian')->nullable();
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
        Schema::dropIfExists('hc_pertanyaan_tambahans');
    }
}
