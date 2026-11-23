<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared("DROP VIEW IF EXISTS nilai_siswa");
        DB::unprepared("
            CREATE VIEW nilai_siswa AS
            SELECT
                s.nis AS NIS,
                s.nama AS Nama,
                s.kelas AS Kelas,
                m.nama_mapel AS Nama_Mapel,
                g.nama AS Nama_Guru,
                n.nilai_ulangan,
                n.nilai_uts,
                n.nilai_uas,
                n.nilai_akhir AS NA
            FROM nilai n
            JOIN siswa s ON n.nis = s.nis
            JOIN guru_mapel gm ON n.id_guru_mapel = gm.id
            JOIN guru g ON gm.nip = g.nip
            JOIN mapel m ON gm.id_mapel = m.id
        ");

        DB::unprepared("DROP PROCEDURE IF EXISTS List_guru");
        DB::unprepared("
            CREATE PROCEDURE List_guru()
            BEGIN
                SELECT
                    g.nip AS NIP,
                    g.nama AS Nama,
                    m.id AS Kode_Mapel,
                    m.nama_mapel AS Nama_Mapel
                FROM guru_mapel gm
                JOIN guru g ON gm.nip = g.nip
                JOIN mapel m ON gm.id_mapel = m.id;
            END
        ");

        DB::unprepared("DROP TRIGGER IF EXISTS hitung");
        DB::unprepared("
            CREATE TRIGGER hitung
            BEFORE INSERT ON nilai
            FOR EACH ROW
            BEGIN
                SET NEW.nilai_akhir = ROUND(
                    (NEW.nilai_ulangan * 0.20) +
                    (NEW.nilai_uts * 0.30) +
                    (NEW.nilai_uas * 0.50)
                );
            END
        ");

        DB::unprepared("DROP TRIGGER IF EXISTS hitung_update");
        DB::unprepared("
            CREATE TRIGGER hitung_update
            BEFORE UPDATE ON nilai
            FOR EACH ROW
            BEGIN
                SET NEW.nilai_akhir = ROUND(
                    (NEW.nilai_ulangan * 0.20) +
                    (NEW.nilai_uts * 0.30) +
                    (NEW.nilai_uas * 0.50)
                );
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP VIEW IF EXISTS nilai_siswa");
        DB::unprepared("DROP PROCEDURE IF EXISTS List_guru");
        DB::unprepared("DROP TRIGGER IF EXISTS hitung");
        DB::unprepared("DROP TRIGGER IF EXISTS hitung_update");
    }
};