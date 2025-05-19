<?php

namespace Database\Seeders;

use App\Models\Headmaster\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Teacher::create(
            [
                "id" => 1,
                "name" => "admin", 
                "username" => "admin",
                "password" => bcrypt("admin"),
                "role" => "kakomli"
            ]
        );
        User::create([
            'name'      => 'Admin',
            'email'     => 'admin123@gmail.com',
            'password'  => Hash::make('iniadmin'),
        ]);
    }
}
