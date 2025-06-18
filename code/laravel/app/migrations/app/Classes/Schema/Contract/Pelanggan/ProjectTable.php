<?php

namespace App\Classes\Schema\Contract\Pelanggan;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class ProjectTable
{
    static function up($connection): void
    {
        $table = "CREATE TABLE IF NOT EXISTS contract.project (
            id VARCHAR(26) NOT NULL,
            old_id VARCHAR(36) NULL,
            entity_id VARCHAR(26) NOT NULL,
            contract_id VARCHAR(26) NOT NULL,
            location_id VARCHAR(26) NOT NULL,
            start_date DATE NOT NULL,
            end_date DATE NOT NULL,
            price NUMERIC(15,2) NOT NULL,
            status VARCHAR(20) DEFAULT 'active',
            duration INTEGER NOT NULL,
            attribute JSONB NULL,
            flags hstore DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL,
            deleted_at TIMESTAMP NULL,
            PRIMARY KEY (id, entity_id),
            UNIQUE (old_id, entity_id),
            FOREIGN KEY (contract_id, entity_id) REFERENCES contract.contract(id, entity_id)
        ) PARTITION BY LIST (entity_id)";
        DB::connection($connection)->statement($table);

        TriggerSetUlid::handle($connection, 'contract', 'project');
        TriggerUpatedAt::handle($connection, 'contract', 'project');
    }
    static public function down($connection): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS contract.project CASCADE");
    }
    // static function dinamis(): string {}
    // static function statis(): string {}
}
