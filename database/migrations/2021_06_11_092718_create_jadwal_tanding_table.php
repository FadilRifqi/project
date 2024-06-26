<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalTandingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_tanding', function (Blueprint $table) {
            $table->id();
            $table->integer('partai');
            $table->foreignId('gelanggang');    
            $table->string('babak');
            $table->string('kelas');
            $table->string('gelombang');
            $table->string('tahap');
            $table->foreignId('sudut_biru');
            $table->foreignId('sudut_merah');
            $table->integer('next_sudut');
            $table->integer('next_partai');
            $table->integer('babak_tanding')->default(1);
            $table->foreignId('pemenang')->nullable();
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
        Schema::dropIfExists('jadwal_tanding');
    }
}
