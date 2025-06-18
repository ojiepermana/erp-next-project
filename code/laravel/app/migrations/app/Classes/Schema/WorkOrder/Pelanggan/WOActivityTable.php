<?php

namespace App\Classes\Schema\WorkOrder\Pelanggan;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class WOActivityTable
{
    static function up($connection, $schema): void
    {
        $table = "CREATE TABLE IF NOT EXISTS $schema.activity (
            id VARCHAR(26) PRIMARY KEY,
            entity_id VARCHAR(26) NOT NULL REFERENCES entity.entity(id),
            old_id VARCHAR(36) NULL UNIQUE,
            wo_id VARCHAR(26) NOT NULL,
            action_id VARCHAR(26) NOT NULL REFERENCES $schema.action(id),
            area VARCHAR(255) NOT NULL,
            sub_area VARCHAR(255) NOT NULL,
            link_to_model_id_type VARCHAR(50) NULL,
            link_to_model_id_installed VARCHAR(26) NULL,
            link_to_asset_id_installed VARCHAR(26) NULL,
            link_to_asset_qty_installed INT NOT NULL DEFAULT 0,
            link_to_model_id_pesticide VARCHAR(26) NULL,
            description TEXT NULL,
            flags hstore DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL,
            deleted_at TIMESTAMP NULL,
            FOREIGN KEY (wo_id, entity_id) REFERENCES $schema.wo(id, entity_id)
            )";
        DB::connection($connection)->statement($table);

        TriggerSetUlid::handle($connection, $schema, 'activity');
        TriggerUpatedAt::handle($connection, $schema, 'activity');
    }
    static public function down($connection, $schema): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS  $schema.activity CASCADE");
    }
}
