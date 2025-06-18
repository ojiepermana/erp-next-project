<?php

namespace App\Classes\Schema\Finance\Pelanggan;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class BillingTable
{
    static function up($connection): void
    {
        $table = "CREATE TABLE IF NOT EXISTS finance.billing (
            id VARCHAR(26) NOT NULL,
            entity_id VARCHAR(26) NOT NULL,
            old_id VARCHAR(36) NULL,
            contract_id VARCHAR(26) NOT NULL,
            location_id VARCHAR(26) NOT NULL,
            type VARCHAR(20) NOT NULL DEFAULT 'billing',
            status VARCHAR(20) NOT NULL DEFAULT 'not',
            tax SMALLINT NOT NULL DEFAULT 11,
            amount INT NOT NULL DEFAULT 0,
            cut INT NOT NULL DEFAULT 0,
            invoice_no VARCHAR(50) NULL,
            flags hstore DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL,
            deleted_at TIMESTAMP NULL,
            PRIMARY KEY (id, entity_id),
            UNIQUE (old_id, entity_id, invoice_no),
            FOREIGN KEY (contract_id, entity_id) REFERENCES contract.contract(id, entity_id),
            FOREIGN KEY (location_id, entity_id) REFERENCES entity.location(id, entity_id)
        ) PARTITION BY LIST (entity_id)";
        DB::connection($connection)->statement($table);

        TriggerSetUlid::handle($connection, 'finance', 'billing');
        TriggerUpatedAt::handle($connection, 'finance', 'billing');
    }
    static public function down($connection): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS  finance.billing CASCADE");
    }
}
