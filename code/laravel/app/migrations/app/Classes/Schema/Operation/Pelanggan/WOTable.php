<?php

namespace App\Classes\Schema\Operation\Pelanggan;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class WOTable
{
    static function up($connection): void
    {
        $table = "CREATE TABLE IF NOT EXISTS operation.workorder (
            id VARCHAR(26) NOT NULL,
            entity_id VARCHAR(26) NOT NULL,
            old_id VARCHAR(36) NULL,
            type VARCHAR(26) NOT NULL DEFAULT 'mobile',
            schedule_id VARCHAR(26) NOT NULL,
            chekin_at TIMESTAMP NULL,
            checkout_at TIMESTAMP NULL,
            attribute JSONB NULL,
            status VARCHAR(26) NOT NULL DEFAULT 'open',
            version VARCHAR(8) NOT NULL DEFAULT '2024.1',
            flags hstore DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL,
            deleted_at TIMESTAMP NULL,
            PRIMARY KEY (id, entity_id),
            UNIQUE (old_id, entity_id),
            FOREIGN KEY (schedule_id, entity_id) REFERENCES operation.schedule(id, entity_id),
            FOREIGN KEY (entity_id) REFERENCES entity.entity(id)
            )  PARTITION BY LIST (entity_id)";
        DB::connection($connection)->statement($table);

        TriggerSetUlid::handle($connection, 'operation', 'workorder');
        TriggerUpatedAt::handle($connection, 'operation', 'workorder');
    }
    static public function down($connection): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS operation.workorder CASCADE");
    }
}
