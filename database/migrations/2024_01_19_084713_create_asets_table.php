<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asets', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor_urut');
            $table->string('slug_aset');
            $table->string('nomor_inventaris');
            $table->string('bulan');
            $table->integer('tahun');
            $table->integer('jenis_id');
            $table->string('merek')->nullable();
            $table->string('processor')->nullable();
            $table->string('ram')->nullable();
            $table->string('hdd')->nullable();
            $table->string('pengguna');
            $table->integer('unit_id');
            $table->integer('lokasi_id');
            $table->string('status');
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
        Schema::dropIfExists('asets');
    }
}
