<?php

namespace App\Classes\Schema\Entity\Pelanggan;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class EnitityTable
{
    static function up($connection): void
    {
        $table = "CREATE TABLE IF NOT EXISTS entity.entity (
            id VARCHAR(26) PRIMARY KEY,
            old_id VARCHAR(36) NULL UNIQUE,
            business_entity_id VARCHAR(26) REFERENCES master.business_entity(id),
            code VARCHAR(5) NULL UNIQUE,
            name VARCHAR(255),
            brand VARCHAR(255) NULL,
            address VARCHAR(255) NULL,
            status VARCHAR(20) DEFAULT 'active',
            url VARCHAR(255) NULL,
            flags hstore DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL,
            deleted_at TIMESTAMP NULL
            )";
        DB::connection($connection)->statement($table);

        TriggerSetUlid::handle($connection, 'entity', 'entity');
        TriggerUpatedAt::handle($connection, 'entity', 'entity');
    }
    static public function down($connection): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS entity.entity CASCADE");
    }
}
