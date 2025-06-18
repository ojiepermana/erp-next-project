<?php

namespace App\Classes\Schema\Master;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class ContractServiceTable
{
    static function up($connection): void
    {
        $table = "CREATE TABLE IF NOT EXISTS master.contract_service (
            id VARCHAR(26) PRIMARY KEY,
            old_id VARCHAR(36) NULL UNIQUE,
            code VARCHAR(5) NULL UNIQUE,
            name VARCHAR(255),
            unit VARCHAR(15) NULL,
            description TEXT,
            status VARCHAR(20) DEFAULT 'active',
            flags hstore DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL,
            deleted_at TIMESTAMP NULL
        )";
        DB::connection($connection)->statement($table);

        TriggerSetUlid::handle($connection, 'master', 'contract_service');
        TriggerUpatedAt::handle($connection, 'master', 'contract_service');

        DB::connection($connection)->statement(self::dinamis());
    }
    static public function down($connection): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS master.contract_service CASCADE");
    }
    static function dinamis(): string
    {
        return "
        INSERT INTO
            master.contract_service (old_id, code, name, unit)
        VALUES
            ('2', NULL, 'Kunjunngan supervisor', '/bulan'),
            ('4', NULL, 'Laporan bulanan', '/bulan'),
            ('6', NULL, 'Audit', '/periode'),
            ('7', NULL, 'Training', '/periode'),
            ('8', NULL, 'Operator Stanby', 'orang');
        ";
    }
    static function statis(): string
    {
        return "
        INSERT INTO
            master.contract_service (id, old_id, code, name, unit)
        VALUES
            ('01jw0hks767n1dgscevf4yxt8b', 2, NULL, 'Kunjunngan supervisor', '/bulan'),
            ('01jw0hks767n1dgscevf4yxt8c', 4, NULL, 'Laporan bulanan', '/bulan'),
            ('01jw0hks767n1dgscevf4yxt8d', 6, NULL, 'Audit', '/periode'),
            ('01jw0hks767n1dgscevf4yxt8e', 7, NULL, 'Training', '/periode'),
            ('01jw0hks767n1dgscevf4yxt8f', 8, NULL, 'Operator Stanby', 'orang');
        ";
    }
}
