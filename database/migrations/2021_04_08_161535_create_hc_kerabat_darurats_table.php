<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHcKerabatDaruratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_kerabat_darurats', function (Blueprint $table) {
            $table->id();
            $table->string('hubungan', 30)->nullable();
            $table->string('nama', 50)->nullable();
            $table->string('jenis_kelamin', 2)->nullable();
            $table->string('telepon', 15)->nullable();
            $table->text('alamat')->nullable();
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
        Schema::dropIfExists('hc_kerabat_darurats');
    }
}
