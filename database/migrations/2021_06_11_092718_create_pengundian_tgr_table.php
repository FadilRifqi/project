<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengundianTGRTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengundian_tgr', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kelompok')->nullable();
            $table->foreignId('atlet_id');
            $table->string('no_undian')->nullable();
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
        Schema::dropIfExists('pengundian_tgr');
    }
}
