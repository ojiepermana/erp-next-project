<?php

namespace App\Classes;

use Illuminate\Support\Facades\DB;

class TriggerSetUlid
{
    static function handle($connection, $schema, $table): void
    {
        $sql = " CREATE TRIGGER before_insert_" . $table . "
            BEFORE INSERT ON " . $schema . "." . $table . "
            FOR EACH ROW
            EXECUTE FUNCTION set_ulid();";
        DB::connection($connection)->unprepared($sql);
    }
}
