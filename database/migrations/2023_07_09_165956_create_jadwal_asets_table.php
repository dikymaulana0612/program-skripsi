<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalAsetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_asets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aset_id')->comment('aset yang akan dijadwalkan');
            $table->dateTime('tgl_jam')->nullable();
            $table->integer('max_pengunjung')->default(30);
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
        Schema::dropIfExists('jadwal_asets');
    }
}
