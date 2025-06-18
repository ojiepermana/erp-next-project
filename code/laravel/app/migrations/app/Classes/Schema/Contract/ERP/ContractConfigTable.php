<?php

namespace App\Classes\Schema\Contract\ERP;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class ContractConfigTable
{
    static function up($connection): void
    {
        $table = "CREATE TABLE IF NOT EXISTS contract.config (
            id VARCHAR(26) PRIMARY KEY,
            contract_id VARCHAR(26) NOT NULL REFERENCES contract.contract(id),
            key_name VARCHAR(255) NOT NULL,
            key_value VARCHAR(255) NOT NULL,
            description TEXT NULL,
            flags hstore DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL,
            deleted_at TIMESTAMP NULL
            )";
        DB::connection($connection)->statement($table);

        TriggerSetUlid::handle($connection, 'contract', 'config');
        TriggerUpatedAt::handle($connection, 'contract', 'config');
    }
    static public function down($connection): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS contract.config CASCADE");
    }

    static public function info(): string
    {
        // billing_type VARCHAR(20) DEFAULT 'before' CHECK (billing_type IN ('before', 'after')),
        // invoice_type VARCHAR(20) DEFAULT 'contract' CHECK (invoice_type IN ('contract', 'location')),
        // term_of_payment SMALLINT DEFAULT 45,
        // classification VARCHAR(1) DEFAULT 'C',

        return "contract.config";
    }
}
