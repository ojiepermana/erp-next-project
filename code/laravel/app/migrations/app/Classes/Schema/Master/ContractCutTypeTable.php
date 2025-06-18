<?php

namespace App\Classes\Schema\Master;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class ContractCutTypeTable
{
    static function up($connection): void
    {
        $table = "CREATE TABLE IF NOT EXISTS master.contract_cut_type (
            id VARCHAR(26) PRIMARY KEY,
            old_id VARCHAR(36) NULL UNIQUE,
            code VARCHAR(5) NULL UNIQUE,
            name VARCHAR(255),
            description TEXT,
            status VARCHAR(20) DEFAULT 'active',
            flags hstore DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL,
            deleted_at TIMESTAMP NULL
    )";
        DB::connection($connection)->statement($table);

        TriggerSetUlid::handle($connection, 'master', 'contract_cut_type');
        TriggerUpatedAt::handle($connection, 'master', 'contract_cut_type');

        DB::connection($connection)->statement(self::dinamis());
    }
    static function down($connection): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS master.contract_cut_type CASCADE");
    }
    static function dinamis(): string
    {
        return "
        INSERT INTO
            master.contract_cut_type (old_id, code, name)
        VALUES
            ('1', NULL, 'Tidak Puas'),
            ('18', NULL, 'Lain - Lain'),
            ('19', NULL, 'Covid 19'),
            ('2', NULL, 'Tidak Ada Masalah'),
            ('3', NULL, 'Harga'),
            ('4', NULL, 'Pergantian vendor'),
            ('5', NULL, 'Tutup / Pindah');
        ";
    }
    static function statis(): string
    {
        return "
        INSERT INTO
            master.contract_cut_type (id, old_id, code, name)
        VALUES
            ('01jw0h6rpd5vr2hetb4ykmg6nt', '1', NULL, 'Tidak Puas'),
            ('01jw0h6rpd5vr2hetb4ykmg6nv', '18', NULL, 'Lain - Lain'),
            ('01jw0h6rpd5vr2hetb4ykmg6nw', '19', NULL, 'Covid 19'),
            ('01jw0h6rpd5vr2hetb4ykmg6nx', '2', NULL, 'Tidak Ada Masalah'),
            ('01jw0h6rpd5vr2hetb4ykmg6ny', '3', NULL, 'Harga'),
            ('01jw0h6rpd5vr2hetb4ykmg6nz', '4', NULL, 'Pergantian vendor'),
            ('01jw0h6rpd5vr2hetb4ykmg6p0', '5', NULL, 'Tutup / Pindah');
        ";
    }
}
