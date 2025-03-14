<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BOMDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("billofmaterialsdetails")->insert(
            [
                "id" => "BOD001",
                "billofmaterials_id" => "BOM001",
                "components_id" => 1,
                "quantity" => 1,
                "price" => 45000 
            ]
        );
    }
}
