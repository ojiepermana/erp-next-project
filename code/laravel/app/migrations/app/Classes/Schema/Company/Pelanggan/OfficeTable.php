<?php

namespace App\Classes\Schema\Company\Pelanggan;

use App\Classes\TriggerSetUlid;
use App\Classes\TriggerUpatedAt;
use Illuminate\Support\Facades\DB;

class OfficeTable
{
    static function up($connection): void
    {
        $table = "CREATE TABLE IF NOT EXISTS company.office (
            id VARCHAR(26) PRIMARY KEY,
            old_id VARCHAR(36) NULL UNIQUE,
            code VARCHAR(10) NULL UNIQUE,
            name VARCHAR(255),
            address TEXT,
            flags hstore DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL,
            deleted_at TIMESTAMP NULL
            )";
        DB::connection($connection)->statement($table);

        TriggerSetUlid::handle($connection, 'company', 'office');
        TriggerUpatedAt::handle($connection, 'company', 'office');
        DB::connection($connection)->statement(self::dinamis());
    }
    static public function down($connection): void
    {
        DB::connection($connection)->statement("DROP TABLE IF EXISTS company.office CASCADE");
    }
    static function dinamis(): string
    {
        return "
            INSERT INTO company.office (old_id, name, code, address) VALUES
                ('1487dc98-0c36-451c-93fc-2087926248d7', 'BANTEN BN', 'BTNBN', 'Jl. Palm Merah Blok BN, RT.5/RW.11, Rawa Buntu, Serpong Sub-District, South Tangerang City, Banten 15310'),
                ('2c7bc000-4547-4a64-b54b-0a5e6cf34461', 'BALI', 'BLI', 'PERUMAHAN TAMAN WIRA GATSU\nJL.GATOT SUBROTO I BLOK B-12 DENPASAR BALI'),
                ('416bb009-19cf-42ff-9ead-15e0d2125e50', 'CIKUPA TRADING', 'CKPTRD', 'Komplek pergudangan griya idola industrial park\nJl. Raya Serang No.Km 12, Bitung Jaya, Kec. Cikupa, Tangerang, Banten 15710'),
                ('4afa7c2c-620a-4218-ab6e-6bd4f0efd5d5', 'GUDANG REGIONAL WILAYAH II - LAMA', 'GRWII', 'Komplek pergudangan griya idola industrial park Jl. Raya Serang No.Km 12, Bitung Jaya, Kec. Cikupa, Tangerang, Banten 15710'),
                ('7d2e6114-1d40-4bc2-aaba-f872e42518dc', 'PONTIANAK', 'PNK', '-'),
                ('BDG', 'BANDUNG', 'BDG', 'Jl. Singgasana Raya No.33, Komplek Singgasana Pradana, Cibaduyut, Bojongloa Kidul, Kota Bandung, Jawa Barat 40236'),
                ('BGR', 'BOGOR', 'BGR', 'Jl. Pangeran Sogiri, Tanah Baru, Kec. Bogor Utara, Kota Bogor, Jawa Barat 16154 (Seberang Sekolah Alam)'),
                ('BKS', 'BEKASI', 'BKS', 'Ruko Orange No.06, Jl Mustika Jaya No.90, Lambangsari Kec Tambun Selatan, Kota Bekasi, Jawa Barat 17510'),
                ('BPP', 'BALIKPAPAN', 'BPP', 'Jalan Indrakila no 38 RT 52\nKelurahan Gunung Samarinda\nKec Balikpapan Utara\nKota Balikpapan 76125\nKalimantan Timur'),
                ('BTM', 'BATAM', 'BTM', 'Ruko Mega Legenda 2 Blok C2 02, Baloi Permai, Batam Kota, Kota Batam.'),
                ('BTN', 'BANTEN', 'BTN', 'Ruko The Icon Business Park Blok F10, Sampora\nKec. Cisauk, Tangerang. 15345'),
                ('c40a5055-e344-4a05-857d-1c102e0ef4a6', 'GUDANG REGIONAL WILAYAH I', 'GRWI', 'Komplek pergudangan griya idola industrial park Jl. Raya Serang No.Km 12, Bitung Jaya, Kec. Cikupa, Tangerang, Banten 15710'),
                ('CRB', 'CIREBON', 'CRB', 'Ruko Citraland Blok G No. 10 Kel. Kalijaga, Kec. Harjamukti Kota Cirebon'),
                ('d26d3d3b-f53f-439d-9366-826b0196bae4', 'BANJARMASIN', 'BJM', 'Jl. Pramuka Komp. Citra Puri No.09, Pemurus Luar, Kec. Banjarmasin Tim., Kota Banjarmasin, Kalimantan Selatan 70654'),
                ('e3782587-3b2f-4cda-b5db-864a5cdaf95b', 'MALANG', 'MLG', 'abcd'),
                ('fe2e3cbc-f56b-4445-8bc4-38a34b8e1c03', 'GUDANG REGIONAL WILAYAH II', 'GRWIII', 'Komplek pergudangan griya idola industrial park Jl. Raya Serang No.Km 12, Bitung Jaya, Kec. Cikupa, Tangerang, Banten 15710'),
                ('GDP', 'CIKUPA', 'GDP', 'Komplek pergudangan griya idola industrial park\nJl. Raya Serang No.Km 12, Bitung Jaya, Kec. Cikupa, Tangerang, Banten 15710'),
                ('JGJ', 'JOGJA', 'JGJ', 'Jl. Perintis Kemerdekaan No 43 \nPandeyan, Umbulharjo Kota Yogyakarta\nDIY 55161'),
                ('JKT', 'JAKARTA', 'JKT', 'Jalan Daan Mogot No 121 A Jakarta Barat DKI Jakarta 11510'),
                ('JMB', 'JAMBI', 'JMB', 'Jl. Syamsudin Uban No 89 RT 15\nKel Jelutung Kec Jelutung Kota Jambi\nJambi 36138'),
                ('JTG', 'JAWA TENGAH', 'JTG', 'Jl. Perkebunan Pesantren No. 20A Branda Bali\n Kec Mijen, Kota Semarang.\nJawa Tengah 50212'),
                ('JTM', 'JAWA TIMUR', 'JTM', 'Fortune Business & Industrial Park Blok C-22 \nJl. Tambak Sawah No.6, Tambakrejo, Kec. Waru, Kabupaten Sidoarjo, Jawa Timur 61256'),
                ('LPG', 'LAMPUNG', 'LPG', 'Jl.Pulau Singkep No 130 Kec. Sukarame Bandar Lampung 35131'),
                ('MDN', 'MEDAN', 'MDN', 'Jl. Padang Golf Komp. CBD Plonia Blok F No. 25 Medan'),
                ('MKS', 'MAKASSAR', 'MKS', 'Jl. Yusuf Bauty Citra Garden Ruko Flavor Walk Blok B/26 Paccinongan Gowa Sulawesi Selatan 92118'),
                ('MND', 'MANADO', 'MND', 'Cluster Amethys Grand Kawanua Blok A11 no 7'),
                ('PKU', 'PEKANBARU', 'PKU', 'Jl. Rawamangun no .77 Rt. 02 Rw 08 Kel. Tangkerang Labui Kec. Bukit Raya Kota Pekanbaru 28281'),
                ('PLB', 'PALEMBANG', 'PLB', 'Jalan Nurdin Panji Komplek Sriwalk F1 B11 Kelurahan Sukamaju Kecamatan Sako Kota Palembang 30164'),
                ('PST', 'HEAD OFFICE', 'PST', 'Jalan Daan Mogot No 121 A Jakarta Barat DKI Jakarta 11510'),
                ('SBY', 'Surabaya', 'SBY', NULL),
                ('SMG', 'Semarang', 'SMG', 'alamat'),
                ('SMR', 'SAMARINDA', 'SMR', '-');
        ";
    }
    static function statis(): string
    {
        return "
            INSERT INTO company.office (old_id, name, code, address) VALUES
                ('1487dc98-0c36-451c-93fc-2087926248d7', 'BANTEN BN', 'BTNBN', 'Jl. Palm Merah Blok BN, RT.5/RW.11, Rawa Buntu, Serpong Sub-District, South Tangerang City, Banten 15310'),
                ('2c7bc000-4547-4a64-b54b-0a5e6cf34461', 'BALI', 'BLI', 'PERUMAHAN TAMAN WIRA GATSU\nJL.GATOT SUBROTO I BLOK B-12 DENPASAR BALI'),
                ('416bb009-19cf-42ff-9ead-15e0d2125e50', 'CIKUPA TRADING', 'CKPTRD', 'Komplek pergudangan griya idola industrial park\nJl. Raya Serang No.Km 12, Bitung Jaya, Kec. Cikupa, Tangerang, Banten 15710'),
                ('4afa7c2c-620a-4218-ab6e-6bd4f0efd5d5', 'GUDANG REGIONAL WILAYAH II - LAMA', 'GRWII', 'Komplek pergudangan griya idola industrial park Jl. Raya Serang No.Km 12, Bitung Jaya, Kec. Cikupa, Tangerang, Banten 15710'),
                ('7d2e6114-1d40-4bc2-aaba-f872e42518dc', 'PONTIANAK', 'PNK', '-'),
                ('BDG', 'BANDUNG', 'BDG', 'Jl. Singgasana Raya No.33, Komplek Singgasana Pradana, Cibaduyut, Bojongloa Kidul, Kota Bandung, Jawa Barat 40236'),
                ('BGR', 'BOGOR', 'BGR', 'Jl. Pangeran Sogiri, Tanah Baru, Kec. Bogor Utara, Kota Bogor, Jawa Barat 16154 (Seberang Sekolah Alam)'),
                ('BKS', 'BEKASI', 'BKS', 'Ruko Orange No.06, Jl Mustika Jaya No.90, Lambangsari Kec Tambun Selatan, Kota Bekasi, Jawa Barat 17510'),
                ('BPP', 'BALIKPAPAN', 'BPP', 'Jalan Indrakila no 38 RT 52\nKelurahan Gunung Samarinda\nKec Balikpapan Utara\nKota Balikpapan 76125\nKalimantan Timur'),
                ('BTM', 'BATAM', 'BTM', 'Ruko Mega Legenda 2 Blok C2 02, Baloi Permai, Batam Kota, Kota Batam.'),
                ('BTN', 'BANTEN', 'BTN', 'Ruko The Icon Business Park Blok F10, Sampora\nKec. Cisauk, Tangerang. 15345'),
                ('c40a5055-e344-4a05-857d-1c102e0ef4a6', 'GUDANG REGIONAL WILAYAH I', 'GRWI', 'Komplek pergudangan griya idola industrial park Jl. Raya Serang No.Km 12, Bitung Jaya, Kec. Cikupa, Tangerang, Banten 15710'),
                ('CRB', 'CIREBON', 'CRB', 'Ruko Citraland Blok G No. 10 Kel. Kalijaga, Kec. Harjamukti Kota Cirebon'),
                ('d26d3d3b-f53f-439d-9366-826b0196bae4', 'BANJARMASIN', 'BJM', 'Jl. Pramuka Komp. Citra Puri No.09, Pemurus Luar, Kec. Banjarmasin Tim., Kota Banjarmasin, Kalimantan Selatan 70654'),
                ('e3782587-3b2f-4cda-b5db-864a5cdaf95b', 'MALANG', 'MLG', 'abcd'),
                ('fe2e3cbc-f56b-4445-8bc4-38a34b8e1c03', 'GUDANG REGIONAL WILAYAH II', 'GRWIII', 'Komplek pergudangan griya idola industrial park Jl. Raya Serang No.Km 12, Bitung Jaya, Kec. Cikupa, Tangerang, Banten 15710'),
                ('GDP', 'CIKUPA', 'GDP', 'Komplek pergudangan griya idola industrial park\nJl. Raya Serang No.Km 12, Bitung Jaya, Kec. Cikupa, Tangerang, Banten 15710'),
                ('JGJ', 'JOGJA', 'JGJ', 'Jl. Perintis Kemerdekaan No 43 \nPandeyan, Umbulharjo Kota Yogyakarta\nDIY 55161'),
                ('JKT', 'JAKARTA', 'JKT', 'Jalan Daan Mogot No 121 A Jakarta Barat DKI Jakarta 11510'),
                ('JMB', 'JAMBI', 'JMB', 'Jl. Syamsudin Uban No 89 RT 15\nKel Jelutung Kec Jelutung Kota Jambi\nJambi 36138'),
                ('JTG', 'JAWA TENGAH', 'JTG', 'Jl. Perkebunan Pesantren No. 20A Branda Bali\n Kec Mijen, Kota Semarang.\nJawa Tengah 50212'),
                ('JTM', 'JAWA TIMUR', 'JTM', 'Fortune Business & Industrial Park Blok C-22 \nJl. Tambak Sawah No.6, Tambakrejo, Kec. Waru, Kabupaten Sidoarjo, Jawa Timur 61256'),
                ('LPG', 'LAMPUNG', 'LPG', 'Jl.Pulau Singkep No 130 Kec. Sukarame Bandar Lampung 35131'),
                ('MDN', 'MEDAN', 'MDN', 'Jl. Padang Golf Komp. CBD Plonia Blok F No. 25 Medan'),
                ('MKS', 'MAKASSAR', 'MKS', 'Jl. Yusuf Bauty Citra Garden Ruko Flavor Walk Blok B/26 Paccinongan Gowa Sulawesi Selatan 92118'),
                ('MND', 'MANADO', 'MND', 'Cluster Amethys Grand Kawanua Blok A11 no 7'),
                ('PKU', 'PEKANBARU', 'PKU', 'Jl. Rawamangun no .77 Rt. 02 Rw 08 Kel. Tangkerang Labui Kec. Bukit Raya Kota Pekanbaru 28281'),
                ('PLB', 'PALEMBANG', 'PLB', 'Jalan Nurdin Panji Komplek Sriwalk F1 B11 Kelurahan Sukamaju Kecamatan Sako Kota Palembang 30164'),
                ('PST', 'HEAD OFFICE', 'PST', 'Jalan Daan Mogot No 121 A Jakarta Barat DKI Jakarta 11510'),
                ('SBY', 'Surabaya', 'SBY', NULL),
                ('SMG', 'Semarang', 'SMG', 'alamat'),
                ('SMR', 'SAMARINDA', 'SMR', '-');
        ";
    }
}
