<?php

namespace App\Classes\Schema\Master;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class LocationTypeTable
{
    static function up($connection): void
    {
        $table = "CREATE TABLE IF NOT EXISTS master.location_type (
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

        TriggerSetUlid::handle($connection, 'master', 'location_type');
        TriggerUpatedAt::handle($connection, 'master', 'location_type');
        DB::connection($connection)->statement(self::dinamis());
    }
    static public function down($connection): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS master.location_type CASCADE");
    }
    static function dinamis(): string
    {
        return "
        INSERT INTO
            master.location_type (old_id, code, name)
        VALUES
            ('BLD', 'BLD', 'Building'),
            ('FAC', 'FAC', 'Factory'),
            ('RES', 'RES', 'Residensial'),
            ('RST', 'RST', 'Resto');
        ";
    }
    static function statis(): string
    {
        return "
        INSERT INTO
            master.location_type (id, old_id, code, name)
        VALUES
            ('01jw2h16zw0ks919r9d98x4e53', 'BLD', 'BLD', 'Building'),
            ('01jw2h16zw0ks919r9d98x4e54', 'FAC', 'FAC', 'Factory'),
            ('01jw2h16zw0ks919r9d98x4e55', 'RES', 'RES', 'Residensial'),
            ('01jw2h16zw0ks919r9d98x4e56', 'RST', 'RST', 'Resto');
        ";
    }
}
