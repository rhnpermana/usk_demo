<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Drop foreign key sementara sebelum mengubah kolom yang direferensikan
        Schema::table('guru_mapel', function (Blueprint $table) {
            $table->dropForeign(['nip']);
        });

        Schema::table('nilai', function (Blueprint $table) {
            $table->dropForeign(['nis']);
        });

        DB::statement('ALTER TABLE guru MODIFY nip BIGINT NOT NULL');
        DB::statement('ALTER TABLE guru_mapel MODIFY nip BIGINT NOT NULL');
        DB::statement('ALTER TABLE siswa MODIFY nis BIGINT NOT NULL');
        DB::statement('ALTER TABLE nilai MODIFY nis BIGINT NOT NULL');

        Schema::table('guru_mapel', function (Blueprint $table) {
            $table->foreign('nip')->references('nip')->on('guru')->onDelete('cascade');
        });

        Schema::table('nilai', function (Blueprint $table) {
            $table->foreign('nis')->references('nis')->on('siswa')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('guru_mapel', function (Blueprint $table) {
            $table->dropForeign(['nip']);
        });

        Schema::table('nilai', function (Blueprint $table) {
            $table->dropForeign(['nis']);
        });

        DB::statement('ALTER TABLE guru MODIFY nip INT NOT NULL');
        DB::statement('ALTER TABLE guru_mapel MODIFY nip INT NOT NULL');
        DB::statement('ALTER TABLE siswa MODIFY nis INT NOT NULL');
        DB::statement('ALTER TABLE nilai MODIFY nis INT NOT NULL');

        Schema::table('guru_mapel', function (Blueprint $table) {
            $table->foreign('nip')->references('nip')->on('guru')->onDelete('cascade');
        });

        Schema::table('nilai', function (Blueprint $table) {
            $table->foreign('nis')->references('nis')->on('siswa')->onDelete('cascade');
        });
    }
};