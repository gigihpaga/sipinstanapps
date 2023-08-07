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
        Schema::disableForeignKeyConstraints();

        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 100)->unique();
            $table->string('nama', 225);
            $table->foreignId('jabatan_id')->index()->nullable();
            $table->foreignId('pangkat_golongan_id')->nullable();
            $table->foreignId('kelas_perjadin_id')->nullable();
            $table->timestamps();

            $table->foreign('jabatan_id')->references('id')->on('jabatan');
            $table->foreign('pangkat_golongan_id')->references('id')->on('pangkat_golongan');
            $table->foreign('kelas_perjadin_id')->references('id')->on('kelas_perjadin');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
