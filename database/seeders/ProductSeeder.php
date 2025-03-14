<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            "category_id" => 1,
            "nama_produk" => "Sepatu karet Pakalolo",
            "harga_modal" => 45000,
            "harga_jual" => 45000,
            "internal_reference" => "SKP"
        ]);
    }
}
