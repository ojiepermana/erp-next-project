<?php

namespace App\Classes\Schema\Master;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class JobTypeTable
{
    static function up($connection): void
    {
        $table = "CREATE TABLE IF NOT EXISTS master.job_type (
            id VARCHAR(26) PRIMARY KEY,
            old_id VARCHAR(36) NULL UNIQUE,
            code VARCHAR(5) NULL UNIQUE,
            name VARCHAR(255),
            description TEXT,
            status VARCHAR(20) DEFAULT 'active',
            sales_share NUMERIC(4,2) DEFAULT 0,
            flags hstore DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL,
            deleted_at TIMESTAMP NULL
    )";
        DB::connection($connection)->statement($table);

        TriggerSetUlid::handle($connection, 'master', 'job_type');
        TriggerUpatedAt::handle($connection, 'master', 'job_type');

        DB::connection($connection)->statement(self::dinamis());
    }
    static public function down($connection): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS master.job_type CASCADE");
    }
    static function dinamis(): string
    {
        return "
        INSERT INTO
            master.job_type (old_id, code, name, sales_share)
        VALUES
            ('F', 'F', 'Free', 1.00),
            ('M', 'M', 'Mobile', 1.00),
            ('OT', 'OT', 'One Time', 1.00),
            ('PNJ', 'PNJ', 'Jual', 1.00),
            ('S', 'S', 'Stand By', 0.60),
            ('SW', 'SW', 'Sewa', 1.00);
        ";
    }
    static function statis(): string
    {
        return "
        INSERT INTO
            master.job_type (id, old_id, code, name, sales_share)
        VALUES
            ('01jw0mphgqk0bcp1y6sztgps6z', 'F', 'F', 'Free', 1.00),
            ('01jw0mphgqk0bcp1y6sztgps70', 'M', 'M', 'Mobile', 1.00),
            ('01jw0mphgqk0bcp1y6sztgps71', 'OT', 'OT', 'One Time', 1.00),
            ('01jw0mphgqk0bcp1y6sztgps72', 'PNJ', 'PNJ', 'Jual', 1.00),
            ('01jw0mphgqk0bcp1y6sztgps73', 'S', 'S', 'Stand By', 0.60),
            ('01jw0mphgqk0bcp1y6sztgps74', 'SW', 'SW', 'Sewa', 1.00);
        ";
    }
}
