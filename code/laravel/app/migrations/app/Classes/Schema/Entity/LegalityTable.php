<?php

namespace App\Classes\Schema\Entity;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class LegalityTable
{
    static function up($connection): void
    {
        $table = "CREATE TABLE IF NOT EXISTS entity.legality (
            id VARCHAR(26) PRIMARY KEY,
            old_id VARCHAR(36) NULL UNIQUE,
            is_primary VARCHAR(2) DEFAULT 'ya' CHECK (is_primary IN ('ya', 'tidak')),
            entity_id VARCHAR(26) NOT NULL REFERENCES entity.entity(id),
            type VARCHAR(10) DEFAULT 'npwp' NULL  CHECK (type IN ('npwp', 'ktp','passport')),
            name VARCHAR(255),
            nomor VARCHAR(255) NULL UNIQUE,
            address TEXT NULL,
            validated_at TIMESTAMP NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL,
            deleted_at TIMESTAMP NULL
            )";
        DB::connection($connection)->statement($table);

        TriggerSetUlid::handle($connection, 'entity', 'legality');
        TriggerUpatedAt::handle($connection, 'entity', 'legality');
    }
    static public function down($connection): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS entity.legality CASCADE");
    }
}
