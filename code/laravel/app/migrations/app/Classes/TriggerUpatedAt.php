<?php

namespace App\Classes;

use Illuminate\Support\Facades\DB;

class TriggerUpatedAt
{
    static function handle($connection, $schema, $table): void
    {
        $sql = " CREATE TRIGGER before_update_" . $table . "
            BEFORE UPDATE ON " . $schema . "." . $table . "
            FOR EACH ROW
            EXECUTE FUNCTION set_updated_timestamp_now();";
        DB::connection($connection)->unprepared($sql);
    }
}
