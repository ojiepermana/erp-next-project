<?php

namespace App\Classes\Schema\Company\ERP;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class OfficeTable
{
    static function up($connection): void
    {
        $table = "CREATE TABLE IF NOT EXISTS company.office (
            id VARCHAR(26) PRIMARY KEY,
            old_id VARCHAR(36) NULL UNIQUE,
            code VARCHAR(5) NULL UNIQUE,
            name VARCHAR(255),
            type VARCHAR(20) DEFAULT 'branch',
            status VARCHAR(20) DEFAULT 'active',
            email VARCHAR(255) NULL UNIQUE,
            phone VARCHAR(20) NULL UNIQUE,
            address VARCHAR(255) NULL,
            latitude DECIMAL(9,6) NULL,
            longitude DECIMAL(9,6) NULL,
            photo_document_id VARCHAR(36) NULL,
            description TEXT,
           
            flags hstore DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL,
            deleted_at TIMESTAMP NULL
            )";
        DB::connection($connection)->statement($table);
        // Tambahkan komentar pada kolom "type"
        DB::connection($connection)->statement("COMMENT ON COLUMN company.office.type IS 'branch, warehouse, satellite';");

        TriggerSetUlid::handle($connection, 'company', 'office');
        TriggerUpatedAt::handle($connection, 'company', 'office');
    }
    static public function down($connection): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS company.office CASCADE");
    }
}
