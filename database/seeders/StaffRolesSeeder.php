<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffRolesSeeder extends Seeder
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
                'id' => 1,
                'role_name' => '管理者',
                'permission_level' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'role_name' => 'コーチ',
                'permission_level' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'role_name' => 'フロントスタッフ',
                'permission_level' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 他のロールデータを追加できます
        ]);
    }
}
