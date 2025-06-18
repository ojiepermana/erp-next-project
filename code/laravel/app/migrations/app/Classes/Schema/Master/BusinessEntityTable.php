<?php

namespace App\Classes\Schema\Master;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class BusinessEntityTable
{
    static function up($connection): void
    {
        $table = "CREATE TABLE IF NOT EXISTS master.business_entity (
            id VARCHAR(26) PRIMARY KEY,
            old_id VARCHAR(36) NULL UNIQUE,
            code VARCHAR(5) NULL UNIQUE,
            prefix VARCHAR(15) NULL,
            name VARCHAR(255),
            suffix VARCHAR(25) NULL,
            description TEXT,
            status VARCHAR(20) DEFAULT 'active',
            flags hstore DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL,
            deleted_at TIMESTAMP NULL
    )";
        DB::connection($connection)->statement($table);

        TriggerSetUlid::handle($connection, 'master', 'business_entity');
        TriggerUpatedAt::handle($connection, 'master', 'business_entity');
        DB::connection($connection)->unprepared(self::dinamis());
    }
    static public function down($connection): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS master.business_entity CASCADE");
    }

    static function dinamis(): string
    {
        return "
        INSERT INTO master.business_entity (old_id, code, prefix, name, suffix) VALUES
            ('1', 'PT', 'PT.', 'Perseroan Terbatas', NULL),
            ('2', 'TBK', 'PT.', 'Perusahaan Terbuka', 'Tbk '),
            ('3', 'KOP', 'Koperasi ', 'Koperasi', NULL),
            ('4', 'PU', NULL, 'Perusahaan Umum', NULL),
            ('5', 'PPS', NULL, 'Perusahaan Perseroan', NULL),
            ('6', 'PPO', NULL, 'Perusahaan Perorangan', NULL),
            ('7', 'FIM', 'Firma ', 'Persekutuan', NULL),
            ('8', 'CV', 'CV.', 'Persekutuan Komanditer', NULL),
            ('9', 'PPD', NULL, 'Persekutuan Perdata', NULL),
            ('10 ', 'YYS', 'Yayasan', 'Yayasan', NULL),
            ('11 ', 'PDA', NULL, 'Perusahaan Daerah', NULL),
            ('12 ', 'RES', NULL, 'Perorangan', NULL);
        ";
    }
    static function statis(): string
    {
        return "
        INSERT INTO master.business_entity (id, old_id, code, prefix, name, suffix) VALUES
            ('01jw2ha1g8jyt4q2xqh1jaybcz', '1', 'PT', 'PT.', 'Perseroan Terbatas', NULL),
            ('01jw2ha1g8jyt4q2xqh1jaybd0', '2', 'TBK', 'PT.', 'Perusahaan Terbuka', 'Tbk '),
            ('01jw2ha1g8jyt4q2xqh1jaybd1', '3', 'KOP', 'Koperasi ', 'Koperasi', NULL),
            ('01jw2ha1g8jyt4q2xqh1jaybd2', '4', 'PU', NULL, 'Perusahaan Umum', NULL),
            ('01jw2ha1g8jyt4q2xqh1jaybd3', '5', 'PPS', NULL, 'Perusahaan Perseroan', NULL),
            ('01jw2ha1g8jyt4q2xqh1jaybd4', '6', 'PPO', NULL, 'Perusahaan Perorangan', NULL),
            ('01jw2ha1g8jyt4q2xqh1jaybd5', '7', 'FIM', 'Firma ', 'Persekutuan', NULL),
            ('01jw2ha1g8jyt4q2xqh1jaybd6', '8', 'CV', 'CV.', 'Persekutuan Komanditer', NULL),
            ('01jw2ha1g8jyt4q2xqh1jaybd7', '9', 'PPD', NULL, 'Persekutuan Perdata', NULL),
            ('01jw2ha1g8jyt4q2xqh1jaybd8', '10 ', 'YYS', 'Yayasan', 'Yayasan', NULL),
            ('01jw2ha1g8jyt4q2xqh1jaybd9', '11 ', 'PDA', NULL, 'Perusahaan Daerah', NULL),
            ('01jw2ha1g8jyt4q2xqh1jaybda', '12 ', 'RES', NULL, 'Perorangan', NULL);";
    }
}
