<?php

namespace Database\Seeders;

use App\Models\Component;
use Illuminate\Database\Seeder;

class ComponentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Component::create([
            "nama" => "Tali",
            "kuantitas" => 4,
            "harga_modal" => 20000,
            "jenis_bahan" => "halus"
        ]);
    }
}
