<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ManufaturingOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategorySeeder::class,
            ComponentsSeeder::class,
            ProductSeeder::class
        ]);
    }
}
