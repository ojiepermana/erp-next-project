<?php

namespace App\Classes\Schema\WorkOrder\Pelanggan;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class WOActivityPesticideTable
{
    static function up($connection, $schema): void
    {
        $table = "CREATE TABLE IF NOT EXISTS $schema.activity_pesticide (
            id VARCHAR(26) PRIMARY KEY,
            entity_id VARCHAR(26) NOT NULL REFERENCES entity.entity(id),
            old_id VARCHAR(36) NULL UNIQUE,
            wo_id VARCHAR(26) NOT NULL,
            wo_activity_id VARCHAR(26) NOT NULL REFERENCES $schema.activity(id),
            model_id VARCHAR(26) NOT NULL,
            name VARCHAR(255) NOT NULL,
            flags hstore DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL,
            deleted_at TIMESTAMP NULL,
            FOREIGN KEY (wo_id, entity_id) REFERENCES $schema.wo(id, entity_id)
            )";
        DB::connection($connection)->statement($table);

        TriggerSetUlid::handle($connection, $schema, 'activity_pesticide');
        TriggerUpatedAt::handle($connection, $schema, 'activity_pesticide');
    }
    static public function down($connection, $schema): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS  $schema.activity_pesticide CASCADE");
    }
}
