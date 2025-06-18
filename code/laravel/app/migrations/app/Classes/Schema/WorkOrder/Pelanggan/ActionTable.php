<?php

namespace App\Classes\Schema\WorkOrder\Pelanggan;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class ActionTable
{
    static function up($connection, $schema): void
    {
        $table = "CREATE TABLE IF NOT EXISTS $schema.action (
            id VARCHAR(26) PRIMARY KEY,
            old_id VARCHAR(36) NULL UNIQUE,
            name VARCHAR(255) NOT NULL,
            status VARCHAR(20) NOT NULL DEFAULT 'active',
            target VARCHAR(30) NOT NULL,
            code VARCHAR(20)  NULL UNIQUE,
            link_to_model_id VARCHAR(26) NULL,
            link_to_model_type VARCHAR(50) NULL,
            link_to_model_number VARCHAR(50) NULL,
            flags hstore DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL,
            deleted_at TIMESTAMP NULL
            )";
        DB::connection($connection)->statement($table);

        TriggerSetUlid::handle($connection, $schema, 'action');
        TriggerUpatedAt::handle($connection, $schema, 'action');
    }
    static public function down($connection, $schema): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS  $schema.action CASCADE");
    }
}
