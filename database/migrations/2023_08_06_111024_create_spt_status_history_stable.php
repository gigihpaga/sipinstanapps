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


        Schema::create('spt_status_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spt_id');
            $table->enum('status', [1, 2, 3, 4, 5, 6])->default(1)->comment('(1: created, 2: revision 3: updated 4: verified 5: rejected 6: approved)');
            $table->enum('status_dilihat', ['Y', 'N'])->default('N')->comment('(Y: Sudah dilhat, N: Belum dilihat');
            $table->string('keterangan', 255)->nullable();
            $table->string('created_by', 255)->nullable();
            $table->string('updated_by', 255)->nullable();
            $table->timestamps();

            $table->foreign('spt_id')->references('id')->on('spt')->onUpdate('cascade');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spt_status_history');
    }
};
