<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            "id" => Customer::getKodeCustomer(),
            "NIK" => 3500121212,
            "name" => "Ridho",
            "notelp" => "019291212",
            "email" => "ridhoarif14@gmail.com",
            "alamat" => "Jl Singosari"
        ];
        Customer::insert($data);
    }
}
