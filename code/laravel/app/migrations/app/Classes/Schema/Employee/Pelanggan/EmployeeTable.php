<?php

namespace App\Classes\Schema\Employee\Pelanggan;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class EmployeeTable
{
    static function up($connection): void
    {
        $table = "CREATE TABLE IF NOT EXISTS employee.employee (
            id VARCHAR(26) PRIMARY KEY,
            old_id VARCHAR(36) NULL UNIQUE,
            nama VARCHAR(255) NOT NULL,
            employee_no VARCHAR(26) NOT NULL,
            flags hstore DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL,
            deleted_at TIMESTAMP NULL
            )";
        DB::connection($connection)->statement($table);

        TriggerSetUlid::handle($connection, 'employee', 'employee');
        TriggerUpatedAt::handle($connection, 'employee', 'employee');
    }
    static public function down($connection): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS employee.employee CASCADE");
    }
}
