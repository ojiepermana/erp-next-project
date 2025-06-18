<?php

namespace App\Classes\Schema\Entity\ERP;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class LocationTable
{
    static function up($connection): void
    {
        $table = "CREATE TABLE IF NOT EXISTS entity.location (
            id VARCHAR(26) PRIMARY KEY,
            old_id VARCHAR(36) NULL UNIQUE,
            office_id VARCHAR(26) NOT NULL REFERENCES company.office (id) ON DELETE CASCADE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL,
            deleted_at TIMESTAMP NULL
            )";
        DB::connection($connection)->statement($table);

        TriggerSetUlid::handle($connection, 'entity', 'location');
        TriggerUpatedAt::handle($connection, 'entity', 'location');
    }
    static public function down($connection): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS entity.location CASCADE");
    }
}
