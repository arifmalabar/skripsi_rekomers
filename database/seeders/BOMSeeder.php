<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BOMSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("billofmaterials")->insert(
            [
                [
                    "id" => "BOM001",
                    "products_id" => 1,
                    "categories_id" => 1,
                    "quantity" => 28,
                    "satuan" => "cm"
                ],
                [
                    "id" => "BOM002",
                    "products_id" => 1,
                    "categories_id" => 1,
                    "quantity" => 28,
                    "satuan" => "cm"
                ]
            ],
            
        );
    }
}
