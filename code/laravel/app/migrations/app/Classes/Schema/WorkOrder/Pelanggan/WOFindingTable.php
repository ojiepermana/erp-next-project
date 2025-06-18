<?php

namespace App\Classes\Schema\WorkOrder\Pelanggan;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class WOFindingTable
{
    static function up($connection, $schema): void
    {
        $table = "CREATE TABLE IF NOT EXISTS $schema.finding (
            id VARCHAR(26) NOT NULL,
            entity_id VARCHAR(26) NOT NULL,
            old_id VARCHAR(36) NULL,
            wo_id VARCHAR(26) NOT NULL,
            area VARCHAR(255) NOT NULL,
            sub_area VARCHAR(255) NOT NULL,
            pest_id VARCHAR(26) NOT NULL REFERENCES master.pest(id),
            qty INT NOT NULL DEFAULT 0,
            description TEXT NULL,
            flags hstore DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL,
            deleted_at TIMESTAMP NULL,
            PRIMARY KEY (id, entity_id),
            UNIQUE (old_id, entity_id),
            FOREIGN KEY (wo_id, entity_id) REFERENCES $schema.wo(id, entity_id),
            FOREIGN KEY (entity_id) REFERENCES entity.entity(id)
            ) PARTITION BY LIST (entity_id)";
        DB::connection($connection)->statement($table);

        TriggerSetUlid::handle($connection, $schema, 'finding');
        TriggerUpatedAt::handle($connection, $schema, 'finding');
    }
    static public function down($connection, $schema): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS  $schema.finding CASCADE");
    }
}
