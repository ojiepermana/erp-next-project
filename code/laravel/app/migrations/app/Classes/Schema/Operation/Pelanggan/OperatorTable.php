<?php

namespace App\Classes\Schema\Operation\Pelanggan;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class OperatorTable
{
    static function up($connection): void
    {
        $table = "CREATE TABLE IF NOT EXISTS operation.operator (
            id VARCHAR(26) NOT NULL,
            entity_id VARCHAR(26) NOT NULL,
            old_id VARCHAR(36) NULL,
            schedule_id VARCHAR(26) NOT NULL,
            employee_id VARCHAR(26) NOT NULL REFERENCES employee.employee(id),
            flags hstore DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL,
            deleted_at TIMESTAMP NULL,
            PRIMARY KEY (id, entity_id),
            UNIQUE (old_id, entity_id),
            FOREIGN KEY (schedule_id, entity_id) REFERENCES operation.schedule(id, entity_id),
            FOREIGN KEY (entity_id) REFERENCES entity.entity(id),
            FOREIGN KEY (employee_id) REFERENCES employee.employee(id)
            )  PARTITION BY LIST (entity_id)";
        DB::connection($connection)->statement($table);

        TriggerSetUlid::handle($connection, 'operation', 'operator');
        TriggerUpatedAt::handle($connection, 'operation', 'operator');
    }
    static public function down($connection): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS operation.operator CASCADE");
    }
}
