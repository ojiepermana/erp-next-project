<?php

namespace App\Classes\Schema\Master;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class BillingDeductionTypeTable
{
    static function up($connection): void
    {
        $table = "CREATE TABLE IF NOT EXISTS master.bill_deduction_type (
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

        TriggerSetUlid::handle($connection, 'master', 'bill_deduction_type');
        TriggerUpatedAt::handle($connection, 'master', 'bill_deduction_type');
        self::seed($connection);
    }
    static public function down($connection): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS master.bill_deduction_type CASCADE");
    }
    static public function seed($connection): void
    {
        DB::connection($connection)->statement(self::dinamis());
    }
    static function dinamis(): string
    {
        return "
        INSERT INTO
            master.bill_deduction_type (old_id, code, name)
        VALUES
            ('6', NULL, 'Diskon'),
            ('7', NULL, 'Pekerjaan tidak 100%'),
            ('8', NULL, 'Kesalahan Data');
        ";
    }
    static function statis(): string
    {
        return "
        INSERT INTO
            master.bill_deduction_type (id, old_id, code, name)
        VALUES
            ('01jw0ftcnwks6hj4zkh2z1gz6w', '6', NULL, 'Diskon'),
            ('01jw0ftcnwks6hj4zkh2z1gz6x', '7', NULL, 'Pekerjaan tidak 100%'),
            ('01jw0ftcnwks6hj4zkh2z1gz6y', '8', NULL, 'Kesalahan Data');
        ";
    }
}
