<?php

namespace App\Classes\Schema\Master;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class PestTable
{
    static function up($connection): void
    {
        $table = "CREATE TABLE IF NOT EXISTS master.pest (
            id VARCHAR(26) PRIMARY KEY,
            old_id VARCHAR(36) NULL UNIQUE,
            code VARCHAR(5) NULL UNIQUE,
            name VARCHAR(255),
            groups VARCHAR(26) NULL,
            genome VARCHAR(26) NULL,
            description TEXT,
            status VARCHAR(20) DEFAULT 'active',
            attribute JSONB DEFAULT NULL,
            flags HSTORE DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL,
            deleted_at TIMESTAMP NULL
        )";
        DB::connection($connection)->statement($table);

        TriggerSetUlid::handle($connection, 'master', 'pest');
        TriggerUpatedAt::handle($connection, 'master', 'pest');
        DB::connection($connection)->statement(self::dinamis());
    }
    static public function down($connection): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS master.pest CASCADE");
    }
    static public function statis(): string
    {
        return  "
            INSERT INTO master.pest (id, old_id, code, name, groups, genome, attribute) VALUES
            ('0068306e0a907332f36f855d65', '2', NULL, 'nyamuk', 'serangga', 'nyamuk', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": \"false\"}'),
            ('0068306e0a36a92adb5458d26', '3', NULL, 'kecoa', 'serangga', 'kecoa', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": \"false\"}'),
            ('0068306e0ad0392aa46525825b', '4', NULL, 'tikus', 'tikus', 'tikus', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": \"false\"}'),
            ('0068306e0a105df45391ebe63e', '5', NULL, 'semut', 'serangga', 'semut', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": \"false\"}'),
            ('0068306e0a63dd6bebcff35075', '7', NULL, 'lalat', 'serangga', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": \"false\"}'),
            ('0068306e0adad7fbd2d8acd3a', '8', NULL, 'Rayap', 'serangga', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('0068306e0aa25edac22b17b51', '9', NULL, 'hama lain', 'serangga', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('0068306e0afdde35cc8566955', '11', NULL, 'Tikus Terperangkap', 'tikus', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('0068306e0a2b3ed8b6243ac63', '12', NULL, 'agas', 'lain-lain', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('0068306e0a1891387f3b605388', '13', NULL, 'Tikus  Mati/Bau', 'tikus', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('0068306e0a3cb99f9789284a8', '14', NULL, 'hama', 'serangga', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('0068306e0a2d5b3e97a8360c2', '15', NULL, 'jentik', 'lain-lain', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('0068306e0a69c8f34029878d', '17', NULL, 'ulat bulu', 'lain-lain', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('0068306e0aa1c78beb327ae0a8', '20', NULL, 'cicak', 'lain-lain', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('0068306e0a79e58271731a88d', '23', NULL, 'tawon', 'lain-lain', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('0068306e0a5d893abbaf9837a7', '24', NULL, 'kupu-kupu', 'lain-lain', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('0068306e0aacb181f5dc5593d4', '25', NULL, 'kucing', 'lain-lain', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('0068306e0ab7fa1b5cc57a179', '26', NULL, 'Store Product Pest', 'hamagudang', 'lalat', '{\"has_laporan\": \"true\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('0068306e0a982413d8a8083d8', '27', NULL, 'laba-laba', 'lain-lain', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('0068306e0a4b4743097c5de6b', '29', NULL, 'Store Product Pest', 'hamagudang', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('0068306e0ad39c8650a27a3c4', '30', NULL, 'Serangga/Hewan Lain', 'hamagudang', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('0068306e0a8b52727f4b6ab85', '31', NULL, 'Termite', 'rayap', 'rayap', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('0068306e0a7bd8d53db40aec2', '32', 'TRI', 'Tribolium', 'hamagudang', 'spp', '{\"has_laporan\": \"true\", \"has_complain\": \"true\", \"has_inspeksi\": \"true\"}'),
            ('0068306e0aee5fbfa225c22917', '33', 'LAS', 'Lasioderma', 'hamagudang', 'spp', '{\"has_laporan\": \"true\", \"has_complain\": \"true\", \"has_inspeksi\": \"true\"}'),
            ('0068306e0ab2d29119d991cae', '34', 'LR', 'Lalat Rumah', 'serangga', 'lalat', '{\"has_laporan\": \"true\", \"has_complain\": \"false\", \"has_inspeksi\": \"true\"}'),
            ('0068306e0a40401c9a9dacea95', '35', 'LH', 'Lalat Hijau', 'serangga', 'lalat', '{\"has_laporan\": \"true\", \"has_complain\": \"false\", \"has_inspeksi\": \"true\"}'),
            ('0068306e0a6898542670d8f8d6', '36', 'LB', 'Lalat Buah', 'serangga', 'lalat', '{\"has_laporan\": \"true\", \"has_complain\": \"false\", \"has_inspeksi\": \"true\"}'),
            ('0068306e0a90eff54ee2faaae', '37', 'LL', 'Lalat Limbah', 'serangga', 'lalat', '{\"has_laporan\": \"true\", \"has_complain\": \"false\", \"has_inspeksi\": \"true\"}'),
            ('0068306e0abc9b3fdfeb7b1dc', '38', 'KG', 'Kecoa German', 'serangga', 'kecoa', '{\"has_laporan\": \"true\", \"has_complain\": \"false\", \"has_inspeksi\": \"true\"}'),
            ('0068306e0a7bf1c2fa6520e819', '39', 'KA', 'Kecoa Amerika', 'serangga', 'kecoa', '{\"has_laporan\": \"true\", \"has_complain\": \"false\", \"has_inspeksi\": \"true\"}'),
            ('0068306e0a8c1e46f98a232589', '40', 'NB', 'Nyamuk Deman Berdarah', 'serangga', 'nyamuk', '{\"has_laporan\": \"true\", \"has_complain\": \"false\", \"has_inspeksi\": \"true\"}'),
            ('0068306e0af1f62cb6e69ae769', '41', 'NR', 'Nyamuk Rumah', 'serangga', 'nyamuk', '{\"has_laporan\": \"true\", \"has_complain\": \"false\", \"has_inspeksi\": \"true\"}'),
            ('0068306e0ab8ed42fa1a489d51', '42', 'SB', 'Semut Bersayap', 'serangga', 'semut', '{\"has_laporan\": \"true\", \"has_complain\": \"false\", \"has_inspeksi\": \"true\"}'),
            ('0068306e0a3f85f63f8a477165', '43', 'ST', 'Semut Tidak Bersayap', 'serangga', 'semut', '{\"has_laporan\": \"true\", \"has_complain\": \"false\", \"has_inspeksi\": \"true\"}'),
            ('0068306e0a521b43983ac6f45c', '44', 'TA', 'Tikus atap', 'tikus', 'tikus', '{\"has_laporan\": \"true\", \"has_complain\": \"false\", \"has_inspeksi\": \"true\"}'),
            ('0068306e0afa85ddf27540a4dc', '45', 'TR', 'Tikus rumah', 'tikus', 'tikus', '{\"has_laporan\": \"true\", \"has_complain\": \"false\", \"has_inspeksi\": \"true\"}'),
            ('0068306e0aba9e9989969d11c', '46', 'TG', 'Tikus got', 'tikus', 'tikus', '{\"has_laporan\": \"true\", \"has_complain\": \"false\", \"has_inspeksi\": \"true\"}'),
            ('0068306e0acf79c0b2a3b699', '47', 'SN', 'Ular', 'lain-lain', 'Lain', '{\"has_laporan\": \"true\", \"has_complain\": \"true\", \"has_inspeksi\": \"true\"}'),
            ('0068306e0a31ea24adf61bd9da', '48', 'BI', 'Burung', 'lain-lain', 'Lain', '{\"has_laporan\": \"true\", \"has_complain\": \"true\", \"has_inspeksi\": \"true\"}');
        ";
    }
    static function dinamis(): string
    {
        return  "
            INSERT INTO master.pest (old_id, code, name, groups, genome, attribute) VALUES
            ('2', NULL, 'nyamuk', 'serangga', 'nyamuk', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": \"false\"}'),
            ('3', NULL, 'kecoa', 'serangga', 'kecoa', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": \"false\"}'),
            ('4', NULL, 'tikus', 'tikus', 'tikus', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": \"false\"}'),
            ('5', NULL, 'semut', 'serangga', 'semut', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": \"false\"}'),
            ('7', NULL, 'lalat', 'serangga', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": \"false\"}'),
            ('8', NULL, 'Rayap', 'serangga', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('9', NULL, 'hama lain', 'serangga', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('11', NULL, 'Tikus Terperangkap', 'tikus', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('12', NULL, 'agas', 'lain-lain', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('13', NULL, 'Tikus  Mati/Bau', 'tikus', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('14', NULL, 'hama', 'serangga', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('15', NULL, 'jentik', 'lain-lain', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('17', NULL, 'ulat bulu', 'lain-lain', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('20', NULL, 'cicak', 'lain-lain', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('23', NULL, 'tawon', 'lain-lain', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('24', NULL, 'kupu-kupu', 'lain-lain', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('25', NULL, 'kucing', 'lain-lain', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('26', NULL, 'Store Product Pest', 'hamagudang', 'lalat', '{\"has_laporan\": \"true\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('27', NULL, 'laba-laba', 'lain-lain', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('29', NULL, 'Store Product Pest', 'hamagudang', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('30', NULL, 'Serangga/Hewan Lain', 'hamagudang', 'lalat', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('31', NULL, 'Termite', 'rayap', 'rayap', '{\"has_laporan\": \"false\", \"has_complain\": \"true\", \"has_inspeksi\": null}'),
            ('32', 'TRI', 'Tribolium', 'hamagudang', 'spp', '{\"has_laporan\": \"true\", \"has_complain\": \"true\", \"has_inspeksi\": \"true\"}'),
            ('33', 'LAS', 'Lasioderma', 'hamagudang', 'spp', '{\"has_laporan\": \"true\", \"has_complain\": \"true\", \"has_inspeksi\": \"true\"}'),
            ('34', 'LR', 'Lalat Rumah', 'serangga', 'lalat', '{\"has_laporan\": \"true\", \"has_complain\": \"false\", \"has_inspeksi\": \"true\"}'),
            ('35', 'LH', 'Lalat Hijau', 'serangga', 'lalat', '{\"has_laporan\": \"true\", \"has_complain\": \"false\", \"has_inspeksi\": \"true\"}'),
            ('36', 'LB', 'Lalat Buah', 'serangga', 'lalat', '{\"has_laporan\": \"true\", \"has_complain\": \"false\", \"has_inspeksi\": \"true\"}'),
            ('37', 'LL', 'Lalat Limbah', 'serangga', 'lalat', '{\"has_laporan\": \"true\", \"has_complain\": \"false\", \"has_inspeksi\": \"true\"}'),
            ('38', 'KG', 'Kecoa German', 'serangga', 'kecoa', '{\"has_laporan\": \"true\", \"has_complain\": \"false\", \"has_inspeksi\": \"true\"}'),
            ('39', 'KA', 'Kecoa Amerika', 'serangga', 'kecoa', '{\"has_laporan\": \"true\", \"has_complain\": \"false\", \"has_inspeksi\": \"true\"}'),
            ('40', 'NB', 'Nyamuk Deman Berdarah', 'serangga', 'nyamuk', '{\"has_laporan\": \"true\", \"has_complain\": \"false\", \"has_inspeksi\": \"true\"}'),
            ('41', 'NR', 'Nyamuk Rumah', 'serangga', 'nyamuk', '{\"has_laporan\": \"true\", \"has_complain\": \"false\", \"has_inspeksi\": \"true\"}'),
            ('42', 'SB', 'Semut Bersayap', 'serangga', 'semut', '{\"has_laporan\": \"true\", \"has_complain\": \"false\", \"has_inspeksi\": \"true\"}'),
            ('43', 'ST', 'Semut Tidak Bersayap', 'serangga', 'semut', '{\"has_laporan\": \"true\", \"has_complain\": \"false\", \"has_inspeksi\": \"true\"}'),
            ('44', 'TA', 'Tikus atap', 'tikus', 'tikus', '{\"has_laporan\": \"true\", \"has_complain\": \"false\", \"has_inspeksi\": \"true\"}'),
            ('45', 'TR', 'Tikus rumah', 'tikus', 'tikus', '{\"has_laporan\": \"true\", \"has_complain\": \"false\", \"has_inspeksi\": \"true\"}'),
            ('46', 'TG', 'Tikus got', 'tikus', 'tikus', '{\"has_laporan\": \"true\", \"has_complain\": \"false\", \"has_inspeksi\": \"true\"}'),
            ('47', 'SN', 'Ular', 'lain-lain', 'Lain', '{\"has_laporan\": \"true\", \"has_complain\": \"true\", \"has_inspeksi\": \"true\"}'),
            ('48', 'BI', 'Burung', 'lain-lain', 'Lain', '{\"has_laporan\": \"true\", \"has_complain\": \"true\", \"has_inspeksi\": \"true\"}');
        ";
    }
}



// Mysql Query 

// SELECT 
//     id_hama old_id,
//     kode code,
//     nama name,
//     `groups`,
//     genom,
//     JSON_OBJECT(
//       'has_laporan', has_laporan,
//       'has_complain', has_complain,
//       'has_inspeksi', has_inspeksi
//     ) AS attribute
// FROM hama;

// Postgres Query

// SELECT
// 	id,old_id, code, name, groups, genome, replace(attribute::text, '"', '\"') AS escaped_attribute
// FROM
// 	master.pest