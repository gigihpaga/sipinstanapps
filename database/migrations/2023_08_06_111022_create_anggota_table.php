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

        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spt_id');
            $table->foreignId('pegawai_id');
            $table->tinyInteger('lama_tugas');
            $table->enum('jabatan_penugasan', [1, 2, 3, 4])->comment('(1: penanggungjawab , 2: pengawas, 3: ketua tim, 4: anggota)');
            $table->timestamps();

            $table->foreign('spt_id')->references('id')->on('spt');
            $table->foreign('pegawai_id')->references('id')->on('pegawai');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota');
    }
};
