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
        Schema::create('berkas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('calon_siswa_id')->unsigned();
            $table->string('file_kk');
            $table->string('file_akta');
            $table->string('file_ijazah');
            $table->timestamps();

            $table->foreign('calon_siswa_id')->references('id')->on('calon_siswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas');
    }
};
