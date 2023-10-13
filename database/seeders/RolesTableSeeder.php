<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->updateOrInsert(
            [
                'id' => 1,
            ],
            [
                'id' => 1,
                'name' => 'Super-Admin',
                'guard_name' => 'web',
                'created_at' => '2022-01-31 15:59:59',
                'updated_at' => '2022-01-31 15:59:59',
            ]
        );

        User::whereId(1)->first()->roles()->sync([1]);
    }
}
