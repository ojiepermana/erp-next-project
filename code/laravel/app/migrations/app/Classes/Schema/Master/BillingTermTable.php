<?php

namespace App\Classes\Schema\Master;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class BillingTermTable
{
    static function up($connection): void
    {
        $table = "CREATE TABLE IF NOT EXISTS master.billing_term (
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

        TriggerSetUlid::handle($connection, 'master', 'billing_term');
        TriggerUpatedAt::handle($connection, 'master', 'billing_term');

        //seed dinamis
        DB::connection($connection)->statement(self::dinamis());
    }
    static public function down($connection): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS master.billing_term CASCADE");
    }
    static function dinamis(): string
    {
        return "
        INSERT INTO master.billing_term (old_id, code, name, status) VALUES
            (1, NULL, 'Surat Tugas', 'off'),
            (2, NULL, 'Work Order', 'active'),
            (3, NULL, 'Kontrak', 'active'),
            (4, NULL, 'Purchase Order', 'active'),
            (5, NULL, 'Lembar Konfirmasi', 'active'),
            (6, NULL, 'Lain-lain', 'active'),
            (7, NULL, 'Berita Acara', 'off'),
            (8, NULL, 'Laporan Bulanan', 'active'),
            (9, NULL, 'Kartu garansi & Monitoring', 'off');
        ";
    }

    static function statis(): string
    {
        return "
        INSERT INTO master.billing_term (id, old_id, code, name, status) VALUES
            ('01jw0gm8srgph805gk0cjgt2cj', 1, NULL, 'Surat Tugas', 'off'),
            ('01jw0gm8srgph805gk0cjgt2ck', 2, NULL, 'Work Order', 'active'),
            ('01jw0gm8srgph805gk0cjgt2cm', 3, NULL, 'Kontrak', 'active'),
            ('01jw0gm8srgph805gk0cjgt2cn', 4, NULL, 'Purchase Order', 'active'),
            ('01jw0gm8srgph805gk0cjgt2cp', 5, NULL, 'Lembar Konfirmasi', 'active'),
            ('01jw0gm8srgph805gk0cjgt2cq', 6, NULL, 'Lain-lain', 'active'),
            ('01jw0gm8srgph805gk0cjgt2cr', 7, NULL, 'Berita Acara', 'off'),
            ('01jw0gm8srgph805gk0cjgt2cs', 8, NULL, 'Laporan Bulanan', 'active'),
            ('01jw0gm8srgph805gk0cjgt2ct', 9, NULL, 'Kartu garansi & Monitoring', 'off');
        ";
    }
}
