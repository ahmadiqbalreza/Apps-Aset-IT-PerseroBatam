<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsetSoftwareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aset_software', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor_urut');
            $table->string('slug_aset');
            $table->string('nomor_inventaris');
            $table->string('bulan');
            $table->integer('tahun');
            $table->string('nama_aplikasi');
            $table->string('unit_pengguna');
            $table->string('jenis_aplikasi');
            $table->string('keterangan');
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
        Schema::dropIfExists('aset_software');
    }
}
