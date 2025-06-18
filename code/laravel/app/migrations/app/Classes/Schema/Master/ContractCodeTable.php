<?php

namespace App\Classes\Schema\Master;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class ContractCodeTable
{
    static function up($connection): void
    {
        $table = "CREATE TABLE IF NOT EXISTS master.contract_code (
            id VARCHAR(26) PRIMARY KEY,
            old_id VARCHAR(36) NULL UNIQUE,
            code VARCHAR(2) NULL UNIQUE,
            name VARCHAR(255),
            description TEXT,
            status VARCHAR(20) DEFAULT 'active',
            flags hstore DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL,
            deleted_at TIMESTAMP NULL
        )";
        DB::connection($connection)->statement($table);

        TriggerSetUlid::handle($connection, 'master', 'contract_code');
        TriggerUpatedAt::handle($connection, 'master', 'contract_code');

        DB::connection($connection)->statement(self::dinamis());
    }
    static public function down($connection): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS master.contract_code CASCADE");
    }
    static function dinamis(): string
    {
        return "
        INSERT INTO
            master.contract_code (old_id, code, name, description)
        VALUES
            ('KB', 'KB', 'Kontrak Baru','Kontrak Baru'),
            ('KF', 'KF', 'Kontrak Gratis','Kontrak Gratis'),
            ('KP', 'KP', 'Kontrak Perpanjangan','Kontrak Perpanjangan'),
            ('KS', 'KS', 'Kontrak Sebulan','Kontrak Sebulan'),
            ('KT', 'KT', 'Kontrak Terlambat','Kontrak Terlambat');
        ";
    }
    static function statis(): string
    {
        return "
        INSERT INTO
            master.contract_code (id, old_id, code, name, description)
        VALUES
            ('01jvyw2hhmvknagbpdrfaxba47', 'KB', 'KB', 'Kontrak Baru','Kontrak Baru'),
            ('01jvyw2hhmvknagbpdrfaxba48', 'KF', 'KF', 'Kontrak Gratis','Kontrak Gratis'),
            ('01jvyw2hhmvknagbpdrfaxba49', 'KP', 'KP', 'Kontrak Perpanjangan','Kontrak Perpanjangan'),
            ('01jvyw2hhmvknagbpdrfaxba4a', 'KS', 'KS', 'Kontrak Sebulan','Kontrak Sebulan'),
            ('01jvyw2hhmvknagbpdrfaxba4b', 'KT', 'KT', 'Kontrak Terlambat','Kontrak Terlambat');
        ";
    }
}
