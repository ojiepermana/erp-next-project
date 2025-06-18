<?php

namespace App\Classes;

use Illuminate\Support\Facades\DB;

class SetUpdatedAt
{
    static function handle($connection): void
    {
        $sql = "CREATE OR REPLACE FUNCTION public.set_updated_timestamp_now()
            RETURNS TRIGGER AS $$
            BEGIN
                NEW.updated_at = CURRENT_TIMESTAMP;
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;";
        DB::connection($connection)->unprepared($sql);
    }
}
