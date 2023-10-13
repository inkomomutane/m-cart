<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            0 => [
                'id' => 1,
                'name' => 'Developer',
                'email' => 'nelson.mutane@mcart.com',
                'created_at' => '2022-01-31 15:59:59',
                'updated_at' => '2022-01-31 15:59:59',
                'password' => \Hash::make('password'),
            ],
        ]);
    }
}
