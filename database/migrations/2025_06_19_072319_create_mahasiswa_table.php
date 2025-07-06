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
            $table->string('Nim')->primary();
            $table->string('Nama');
            $table->date('Tanggallahir');
            $table->string('Telp');
            $table->string('Email')->unique();
            $table->string('password');
            $table->string('foto')->nullable();
            $table->unsignedBigInteger('id');
            $table->timestamps();
            
            $table->foreign('id')->references('id')->on('prodi')->onDelete('cascade');
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
