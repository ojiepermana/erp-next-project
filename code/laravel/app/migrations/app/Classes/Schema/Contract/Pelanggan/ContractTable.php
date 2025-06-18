<?php

namespace App\Classes\Schema\Contract\Pelanggan;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class ContractTable
{
    static function up($connection): void
    {
        $table = "CREATE TABLE IF NOT EXISTS contract.contract (
            id VARCHAR(26) NOT NULL,
            old_id VARCHAR(36) NULL,
            status VARCHAR(20) DEFAULT 'active',
            employee_id VARCHAR(26) REFERENCES employee.employee(id),
            entity_id VARCHAR(26) NOT NULL REFERENCES entity.entity(id),
            contract_type_id VARCHAR(26) NOT NULL REFERENCES master.contract_type(id),
            job_type_id VARCHAR(26) NOT NULL REFERENCES master.job_type(id),
            office_id VARCHAR(26) NOT NULL REFERENCES company.office(id),
            contract_code_id VARCHAR(26) NOT NULL REFERENCES master.contract_code(id),
            contract_location_type_id VARCHAR(26) NOT NULL REFERENCES master.location_type(id),
            contract_number VARCHAR(255) NULL,
            start_date DATE NOT NULL,
            end_date DATE NOT NULL,
            description TEXT NULL,
            attribute JSONB NULL,
            flags hstore DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL,
            deleted_at TIMESTAMP NULL,
            PRIMARY KEY (id, entity_id),
            UNIQUE (old_id, contract_number, entity_id)
            ) PARTITION BY LIST (entity_id)";
        DB::connection($connection)->statement($table);

        TriggerSetUlid::handle($connection, 'contract', 'contract');
        TriggerUpatedAt::handle($connection, 'contract', 'contract');
    }
    static public function down($connection): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS contract.contract CASCADE");
    }
}
