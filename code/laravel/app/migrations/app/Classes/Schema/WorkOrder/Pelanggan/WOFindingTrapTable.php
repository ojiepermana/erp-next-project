<?php

namespace App\Classes\Schema\WorkOrder\Pelanggan;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class WOFindingTrapTable
{
    static function up($connection, $schema): void
    {
        $table = "CREATE TABLE IF NOT EXISTS $schema.finding_trap (
            id VARCHAR(26) PRIMARY KEY,
            entity_id VARCHAR(26) NOT NULL REFERENCES entity.entity(id),
            old_id VARCHAR(36) NULL UNIQUE,
            wo_finding_id VARCHAR(26) NOT NULL,
            pest_id VARCHAR(26) NOT NULL REFERENCES master.pest(id),
            trap_id VARCHAR(26) NOT NULL,
            link_to_model_id VARCHAR(26) NULL,
            link_to_model_id_number VARCHAR(50) NULL,
            qty_in_trap INT NOT NULL DEFAULT 0,
            qty_out_trap INT NOT NULL DEFAULT 0,
            description TEXT NULL,
            flags hstore DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL,
            deleted_at TIMESTAMP NULL,
            FOREIGN KEY (wo_finding_id, entity_id) REFERENCES $schema.finding(id, entity_id)
            )";
        DB::connection($connection)->statement($table);

        TriggerSetUlid::handle($connection, $schema, 'finding_trap');
        TriggerUpatedAt::handle($connection, $schema, 'finding_trap');
    }
    static public function down($connection, $schema): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS  $schema.finding_trap CASCADE");
    }
}
