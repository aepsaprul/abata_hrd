<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHcKontraksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_kontraks', function (Blueprint $table) {
            $table->id();
            $table->date('mulai_kontrak')->nullable();
            $table->date('akhir_kontrak')->nullable();
            $table->string('lama_kontrak')->nullable();
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
        Schema::dropIfExists('hc_kontraks');
    }
}
