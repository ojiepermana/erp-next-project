<?php

namespace App\Classes\Schema\WorkOrder\Pelanggan;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class WOConditionTable
{
    static function up($connection, $schema): void
    {
        $table = "CREATE TABLE IF NOT EXISTS $schema.condition (
            id VARCHAR(26) PRIMARY KEY,
            entity_id VARCHAR(26) NOT NULL REFERENCES entity.entity(id),
            old_id VARCHAR(36) NULL UNIQUE,
            wo_id VARCHAR(26) NOT NULL,
            area VARCHAR(255) NOT NULL,
            sub_area VARCHAR(255) NOT NULL,
            sanitation VARCHAR(255) NOT NULL,
            sanitation_photo_file_id VARCHAR(26) NULL,
            construction VARCHAR(255) NOT NULL,
            construction_photo_file_id VARCHAR(26) NULL,
            flags hstore DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL,
            deleted_at TIMESTAMP NULL,
            FOREIGN KEY (wo_id, entity_id) REFERENCES $schema.wo(id, entity_id)
            )";
        DB::connection($connection)->statement($table);

        TriggerSetUlid::handle($connection, $schema, 'condition');
        TriggerUpatedAt::handle($connection, $schema, 'condition');
    }
    static public function down($connection, $schema): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS  $schema.condition CASCADE");
    }
}
