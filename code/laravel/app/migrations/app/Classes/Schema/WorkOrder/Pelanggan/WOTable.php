<?php

namespace App\Classes\Schema\WorkOrder\Pelanggan;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class WOTable
{
    static function up($connection, $schema): void
    {
        $table = "CREATE TABLE IF NOT EXISTS $schema.wo (
            id VARCHAR(26),
            entity_id VARCHAR(26) NOT NULL REFERENCES entity.entity(id),
            old_id VARCHAR(36) NULL,
            status VARCHAR(26) NOT NULL DEFAULT 'open',
            schedule_id VARCHAR(26) NOT NULL,
            chekin_at TIMESTAMP NULL,
            chekin_file_id VARCHAR(26) NULL,
            checkout_at TIMESTAMP NULL,
            checkout_file_id VARCHAR(26) NULL,
            sign_pic VARCHAR(255) NULL,
            stamp_file_id VARCHAR(26) NULL,
            attribute JSONB NULL,
            flags hstore DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL,
            deleted_at TIMESTAMP NULL,
            PRIMARY KEY (id, entity_id),
            UNIQUE (old_id, entity_id),
            FOREIGN KEY (schedule_id, entity_id) REFERENCES operation.schedule(id, entity_id),
            FOREIGN KEY (entity_id) REFERENCES entity.entity(id)
            ) PARTITION BY LIST (entity_id)";
        DB::connection($connection)->statement($table);

        TriggerSetUlid::handle($connection, $schema, 'wo');
        TriggerUpatedAt::handle($connection, $schema, 'wo');
    }
    static public function down($connection, $schema): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS  $schema.wo CASCADE");
    }
}
