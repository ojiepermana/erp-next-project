<?php

namespace App\Classes\Schema\Operation\Pelanggan;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class ScheduleTable
{
    static function up($connection): void
    {
        $table = "CREATE TABLE IF NOT EXISTS operation.schedule (
            id VARCHAR(26) NOT NULL,
            entity_id VARCHAR(26) NOT NULL,
            old_id VARCHAR(36) NULL ,
            project_id VARCHAR(26) NOT NULL,
            stats VARCHAR(26) NOT NULL DEFAULT 'dijadwalkan',
            start_at TIMESTAMP NOT NULL,
            end_at TIMESTAMP NOT NULL,
            spko VARCHAR(26) NULL,
            supervisor_employee_id VARCHAR(26) NULL REFERENCES employee.employee(id),
            flags hstore DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL,
            deleted_at TIMESTAMP NULL,
            PRIMARY KEY (id, entity_id),
            UNIQUE (old_id, entity_id, spko),
            FOREIGN KEY (project_id, entity_id) REFERENCES contract.project(id, entity_id),
            FOREIGN KEY (supervisor_employee_id) REFERENCES employee.employee(id),
            FOREIGN KEY (entity_id) REFERENCES entity.entity(id)
            ) PARTITION BY LIST (entity_id)";
        DB::connection($connection)->statement($table);

        TriggerSetUlid::handle($connection, 'operation', 'schedule');
        TriggerUpatedAt::handle($connection, 'operation', 'schedule');
    }
    static public function down($connection): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS operation.schedule CASCADE");
    }
}
