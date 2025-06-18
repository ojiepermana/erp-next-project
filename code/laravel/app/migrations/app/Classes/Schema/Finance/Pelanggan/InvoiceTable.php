<?php

namespace App\Classes\Schema\Finance\Pelanggan;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class InvoiceTable
{
    static function up($connection): void
    {
        $table = "CREATE TABLE IF NOT EXISTS finance.invoice (
            id VARCHAR(26) NOT NULL,
            invoice_at DATE NOT NULL,
            entity_id VARCHAR(26) NOT NULL,
            old_id VARCHAR(36) NULL,
            billing_id VARCHAR(26) NOT NULL,
            dpp INT NOT NULL DEFAULT 0,
            ppn INT NOT NULL DEFAULT 0,
            pph INT NOT NULL DEFAULT 0,
            flags hstore DEFAULT NULL,
            faktur_no VARCHAR(50) NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL,
            deleted_at TIMESTAMP NULL,
            PRIMARY KEY (id, entity_id),
            UNIQUE (old_id, entity_id, faktur_no),
            FOREIGN KEY (billing_id, entity_id) REFERENCES finance.billing(id, entity_id),
            FOREIGN KEY (entity_id) REFERENCES entity.entity(id)
            ) PARTITION BY LIST (entity_id)";
        DB::connection($connection)->statement($table);

        TriggerSetUlid::handle($connection, 'finance', 'invoice');
        TriggerUpatedAt::handle($connection, 'finance', 'invoice');
    }
    static public function down($connection): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS  finance.invoice CASCADE");
    }
}
