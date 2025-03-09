<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staff_roles')->insert([
            [
                'role_name' => '管理者',
                'permission_level' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_name' => 'コーチ',
                'permission_level' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_name' => 'フロントスタッフ',
                'permission_level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
