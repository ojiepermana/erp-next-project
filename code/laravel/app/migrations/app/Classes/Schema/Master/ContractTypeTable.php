<?php

namespace App\Classes\Schema\Master;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ContractTypeTable
{
    static function up($connection): void
    {
        $table = "CREATE TABLE IF NOT EXISTS master.contract_type (
            id VARCHAR(26) PRIMARY KEY,
            old_id VARCHAR(36) NULL UNIQUE,
            code VARCHAR(5) NULL UNIQUE,
            name VARCHAR(255),
            description TEXT,
            status VARCHAR(20) DEFAULT 'active',
            flags hstore DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL,
            deleted_at TIMESTAMP NULL
    )";
        DB::connection($connection)->statement($table);

        TriggerSetUlid::handle($connection, 'master', 'contract_type');
        TriggerUpatedAt::handle($connection, 'master', 'contract_type');

        DB::connection($connection)->statement(self::dinamis());
    }
    static public function down($connection): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS master.contract_type CASCADE");
    }
    static function dinamis(): string
    {
        return "
        INSERT INTO
            master.contract_type (old_id, code, name, description)
        VALUES
            ('ALT', NULL, 'Alat', 'Pembelian / Sewa Alat'),
            ('DIS', NULL, 'Disinfektan', 'Jasa Disinfektan'),
            ('F', NULL, 'Fumigasi', 'Service Fumigasi'),
            ('I', NULL, 'Insect', 'Service Pengendalian Serangga'),
            ('INT', NULL, 'Internal', 'Pengambilan Internal'),
            ('IR', NULL, 'Insect & Rodent', 'Service Pengendalian Serangga & Tikus'),
            ('IRB', NULL, 'Insect Rodent & Bird', 'Service Pengendalian Serangga, Tikus & Burung'),
            ('IRS', NULL, 'Insect Rodent & SPP', 'Service Pengendalian Serangga, Tikus & Hama Gudang'),
            ('IRU', NULL, 'Insect  Rodent & Snake', 'Service Pengendalian Serangga ,Tikus dan Ular'),
            ('K', NULL, 'Kecoa', 'Service Pengendalian Kecoa'),
            ('KR', NULL, 'Kecoa & Rodent', 'Service Pengendalian Serangga Kecoa & Tikus'),
            ('L', NULL, 'Lalat', 'Service Pengendalian lalat'),
            ('LL', NULL, 'Lain-Lain', 'Service Pengendalian Hama Lain'),
            ('N', NULL, 'Nyamuk', 'Service Pengendalian Nyamuk'),
            ('R', NULL, 'Rodent', 'Service Pengendalian Tikus'),
            ('S', NULL, 'Semut', 'Jasa Pengendalian Hama Semut'),
            ('SPP', NULL, 'SPP', 'Service Pengendalian Hama Gudang'),
            ('T', NULL, 'Termite', 'Service Pengendalian Rayap');
        ";
    }
    static public function statis(): string
    {
        return "
        INSERT INTO
            master.contract_type (id, old_id, code, name, description)
        VALUES
           ('01jw0kfkwcfrxpd13bmkn8dvfg', 'ALT', NULL, 'active', 'Alat', 'Pembelian / Sewa Alat'),
                    ('01jw0kfkwcfrxpd13bmkn8dvfh', 'DIS', NULL, 'active', 'Disinfektan', 'Jasa Disinfektan'),
                    ('01jw0kfkwcfrxpd13bmkn8dvfj', 'F', NULL, 'active', 'Fumigasi', 'Service Fumigasi'),
                    ('01jw0kfkwcfrxpd13bmkn8dvfk', 'I', NULL, 'active', 'Insect', 'Service Pengendalian Serangga'),
                    ('01jw0kfkwcfrxpd13bmkn8dvfm', 'INT', NULL, 'active', 'Internal', 'Pengambilan Internal'),
                    ('01jw0kfkwcfrxpd13bmkn8dvfn', 'IR', NULL, 'active', 'Insect & Rodent', 'Service Pengendalian Serangga & Tikus'),
                    ('01jw0kfkwcfrxpd13bmkn8dvfp', 'IRB', NULL, 'active', 'Insect Rodent & Bird', 'Service Pengendalian Serangga, Tikus & Burung'),
                    ('01jw0kfkwcfrxpd13bmkn8dvfq', 'IRS', NULL, 'active', 'Insect Rodent & SPP', 'Service Pengendalian Serangga, Tikus & Hama Gudang'),
                    ('01jw0kfkwcfrxpd13bmkn8dvfr', 'IRU', NULL, 'active', 'Insect  Rodent & Snake', 'Service Pengendalian Serangga ,Tikus dan Ular'),
                    ('01jw0kfkwcfrxpd13bmkn8dvfs', 'K', NULL, 'off', 'Kecoa', 'Service Pengendalian Kecoa'),
                    ('01jw0kfkwcfrxpd13bmkn8dvft', 'KR', NULL, 'off', 'Kecoa & Rodent', 'Service Pengendalian Serangga Kecoa & Tikus'),
                    ('01jw0kfkwcfrxpd13bmkn8dvfv', 'L', NULL, 'off', 'Lalat', 'Service Pengendalian lalat'),
                    ('01jw0kfkwcfrxpd13bmkn8dvfw', 'LL', NULL, 'active', 'Lain-Lain', 'Service Pengendalian Hama Lain'),
                    ('01jw0kfkwcfrxpd13bmkn8dvfx', 'N', NULL, 'off', 'Nyamuk', 'Service Pengendalian Nyamuk'),
                    ('01jw0kfkwcfrxpd13bmkn8dvfy', 'R', NULL, 'active', 'Rodent', 'Service Pengendalian Tikus'),
                    ('01jw0kfkwcfrxpd13bmkn8dvfz', 'S', NULL, 'off', 'Semut', 'Jasa Pengendalian Hama Semut'),
                    ('01jw0kfkwcfrxpd13bmkn8dvg0', 'SPP', NULL, 'active', 'SPP', 'Service Pengendalian Hama Gudang'),
                    ('01jw0kfkwcfrxpd13bmkn8dvg1', 'T', NULL, 'active', 'Termite', 'Service Pengendalian Rayap');";
    }
}
