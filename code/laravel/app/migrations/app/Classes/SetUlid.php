<?php

namespace App\Classes;

use Illuminate\Support\Facades\DB;

class SetUlid
{
    static function handle($connection): void
    {
        $sql = "CREATE OR REPLACE FUNCTION public.set_ulid()
            RETURNS TRIGGER AS $$
            BEGIN
                IF NEW.id IS NULL THEN
                    NEW.id := generate_ulid();
                END IF;
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;";
        DB::connection($connection)->unprepared($sql);
    }
}
