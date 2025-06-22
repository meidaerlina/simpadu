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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->string('nim')->primary();
            $table->string('nama');
            $table->date('tanggal_lahir');
            $table->string('telp');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('foto')->nullable();
            $table->unsignedBigInteger('id_prodi');
            $table->timestamps();

            $table->foreign('id_prodi')->references('id')->on('prodi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
