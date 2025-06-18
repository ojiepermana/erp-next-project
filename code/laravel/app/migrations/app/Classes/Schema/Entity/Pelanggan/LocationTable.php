<?php

namespace App\Classes\Schema\Entity\Pelanggan;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class LocationTable
{
    static function up($connection): void
    {
        // Buat tabel induk dengan partisi
        $table = "CREATE TABLE IF NOT EXISTS entity.location (
            id VARCHAR(26),
            old_id VARCHAR(36) NULL,
            office_id VARCHAR(26) NOT NULL REFERENCES company.office (id),
            entity_id VARCHAR(26) NOT NULL REFERENCES entity.entity (id),
            location_type_id  VARCHAR(26) NOT NULL REFERENCES master.location_type (id),
            name VARCHAR(255) NOT NULL,
            address TEXT NULL,
            flags hstore DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL,
            deleted_at TIMESTAMP NULL,
            PRIMARY KEY (id, entity_id),
            UNIQUE (old_id, entity_id)
        ) PARTITION BY LIST (entity_id)";
        DB::connection($connection)->statement($table);

        // Contoh partisi berdasarkan code (misal: 'ETSA', 'ETOS', 'BJTS')
        // $code = strtolower('ETOS');
        // DB::connection($connection)->statement("
        // CREATE TABLE IF NOT EXISTS entity.location_A PARTITION OF entity.location
        // FOR VALUES IN ('A')
        // ");


        // Index pada office_id dan entity_id
        DB::connection($connection)->statement("CREATE INDEX IF NOT EXISTS idx_location_office_id ON entity.location (office_id);");
        DB::connection($connection)->statement("CREATE INDEX IF NOT EXISTS idx_location_entity_id ON entity.location (entity_id);");

        TriggerSetUlid::handle($connection, 'entity', 'location');
        TriggerUpatedAt::handle($connection, 'entity', 'location');
    }
    static public function down($connection): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS entity.location CASCADE");
    }
}
