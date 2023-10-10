<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('asset_id')->nullable();
            $table->foreignId('jadwal_asset_id')->nullable();
            $table->string('no_tiket')->nullable();
            $table->integer('jml_orang')->nullable()->default(1);
            $table->text('komplen')->nullable()->comment('hanya terisi jika memang ada komplen');
            $table->string('status')->nullable()->default('pending')->comment('pending,paid,used');
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
        Schema::dropIfExists('bookings');
    }
}
