<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rekamans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pasien_id');
            $table->string('nomor', 255);
            $table->string('jenis_pelayanan', 255);
            $table->string('poli', 255);
            $table->string('diagnosa', 255);
            $table->string('terapi', 255);
            $table->text('keterangan');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('pasien_id')->references('id')->on('pasiens');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekamans');
    }
};
