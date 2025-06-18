<?php

namespace App\Classes\Schema\Master;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class BillingCancelledTypeTable
{
    static function up($connection): void
    {
        $table = "CREATE TABLE IF NOT EXISTS master.bill_cancelled_type (
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

        TriggerSetUlid::handle($connection, 'master', 'bill_cancelled_type');
        TriggerUpatedAt::handle($connection, 'master', 'bill_cancelled_type');

        self::seed($connection);
    }
    static public function down($connection): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS master.bill_cancelled_type CASCADE");
    }
    static public function seed($connection): void
    {
        DB::connection($connection)->statement(self::dinamis());
    }
    static  function dinamis(): string
    {
        return "
        INSERT INTO
            master.bill_cancelled_type (old_id, code, name)
        VALUES
            ('10', NULL, 'Internal'),
            ('11', NULL, 'Putus'),
            ('12', NULL, 'Lain-Lain'),
            ('17', NULL, 'Covid 19'),
            ('9', NULL, 'Pelanggan');
        ";
    }
    static function statis(): string
    {
        return "
        INSERT INTO
            master.bill_cancelled_type (id, old_id, code, name)
        VALUES
            ('01jw0fe6ec9xtasq5v9jrprnpa','10', NULL, 'Internal'),
            ('01jw0fe6ec9xtasq5v9jrprnpb','11', NULL, 'Putus'),
            ('01jw0fe6ec9xtasq5v9jrprnpc','12', NULL, 'Lain-Lain'),
            ('01jw0fe6ec9xtasq5v9jrprnpd','17', NULL, 'Covid 19'),
            ('01jw0fe6ec9xtasq5v9jrprnpe','9', NULL, 'Pelanggan');
        ";
    }
}
