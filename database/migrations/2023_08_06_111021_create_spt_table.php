<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::disableForeignKeyConstraints();

        Schema::create('spt', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pka_id');
            $table->foreignId('pemohon_spt')->nullable();
            $table->enum('sifat_tugas', ['PKPT', 'Non-PKPT'])->comment('enum(PKPT, Non-PKPT)')->nullable();
            $table->enum('status_buat', [0, 1])->default(0)->comment('(0: draft , 1: selesai)');
            $table->string('nomor_pengajuan', 100)->nullable();
            $table->unsignedTinyInteger('lama_penugasan')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->string('file_pengajuan_spt', 255)->nullable();
            $table->longText('keperluan_tugas')->nullable();
            $table->longText('keterangan_tugas')->nullable();
            $table->mediumText('note')->nullable();
            $table->string('created_by', 255)->nullable();
            $table->string('updated_by', 255)->nullable();
            $table->timestamps();

            $table->foreign('pka_id')->references('id')->on('pka')->onUpdate('cascade');
            $table->foreign('pemohon_spt')->references('id')->on('users')->onUpdate('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spt');
    }
};
