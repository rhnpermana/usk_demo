<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guru', function (Blueprint $table) {
            $table->integer('nip')->primary();
            $table->string('nama', 100);
            $table->timestamps();
        });

        Schema::create('siswa', function (Blueprint $table) {
            $table->integer('nis')->primary();
            $table->string('nama', 100);
            $table->string('kelas', 50);
            $table->timestamps();
        });

        Schema::create('mapel', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_mapel', 100);
            $table->timestamps();
        });

        Schema::create('guru_mapel', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nip');
            $table->unsignedInteger('id_mapel');
            $table->timestamps();

            $table->foreign('nip')->references('nip')->on('guru')->onDelete('cascade');
            $table->foreign('id_mapel')->references('id')->on('mapel')->onDelete('cascade');
        });

        Schema::create('nilai', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nis');
            $table->integer('nilai_ulangan')->default(0);
            $table->integer('nilai_uts')->default(0);
            $table->integer('nilai_uas')->default(0);
            $table->integer('nilai_akhir')->default(0);
            $table->unsignedInteger('id_guru_mapel');
            $table->timestamps();

            $table->foreign('nis')->references('nis')->on('siswa')->onDelete('cascade');
            $table->foreign('id_guru_mapel')->references('id')->on('guru_mapel')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai');
        Schema::dropIfExists('guru_mapel');
        Schema::dropIfExists('mapel');
        Schema::dropIfExists('siswa');
        Schema::dropIfExists('guru');
    }
};