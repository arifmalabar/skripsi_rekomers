<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataBahan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['nama' => 'Kanvas', 'kuantitas' => 50, 'harga_modal' => 30000],
            ['nama' => 'Sol Karet', 'kuantitas' => 2, 'harga_modal' => 15000],
            ['nama' => 'Insole', 'kuantitas' => 30, 'harga_modal' => 10000],
            ['nama' => 'Benang Jahit', 'kuantitas' => 100, 'harga_modal' => 8000],
            ['nama' => 'Lem Sepatu', 'kuantitas' => 200, 'harga_modal' => 10000],
            ['nama' => 'Tali Sepatu', 'kuantitas' => 2, 'harga_modal' => 5000],
            ['nama' => 'Prexson', 'kuantitas' => 30, 'harga_modal' => 15000],
            ['nama' => 'Eyelet', 'kuantitas' => 12, 'harga_modal' => 12000],
            ['nama' => 'Busa / Foam', 'kuantitas' => 50, 'harga_modal' => 25000],
            ['nama' => 'Furing', 'kuantitas' => 50, 'harga_modal' => 10000],
        ];
        DB::table('components')->insert($data);
    }
}
