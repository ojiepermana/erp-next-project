<?php

namespace App\Classes;

use Illuminate\Support\Facades\DB;

class GenerateUlid
{
    static function handle($connection): void
    {
        $sql = "CREATE OR REPLACE FUNCTION public.generate_ulid()
        RETURNS TEXT AS $$
        DECLARE
            ts_part TEXT;
            random_part TEXT;
            ulid TEXT;
        BEGIN
            -- Generate timestamp-based part
            ts_part := lpad(to_hex(EXTRACT(EPOCH FROM clock_timestamp())::BIGINT), 10, '0');

            -- Generate random part (16 characters)
            random_part := (
                SELECT string_agg(to_hex((random() * 255)::INT), '')
                FROM generate_series(1, 8)
            );

            -- Concatenate the parts
            ulid := ts_part || random_part;

            RETURN ulid;
        END;
        $$ LANGUAGE plpgsql;";
        DB::connection($connection)->unprepared($sql);
    }
}
