<?php

namespace App\Classes\Schema\Company\ERP;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class OfficeConfigTable
{
    static function up($connection): void
    {
        $table = "CREATE TABLE IF NOT EXISTS company.office_config (
            id VARCHAR(26) PRIMARY KEY,
            office_id VARCHAR(26) NOT NULL REFERENCES company.office(id),
            name VARCHAR(255),
            value VARCHAR(20) NULL,
            description TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL,
            deleted_at TIMESTAMP NULL
            )";
        DB::connection($connection)->statement($table);

        TriggerSetUlid::handle($connection, 'company', 'office_config');
        TriggerUpatedAt::handle($connection, 'company', 'office_config');
    }
    static public function down($connection): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS company.office_config CASCADE");
    }
}
