<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staff')->insert([
            [
                'last_name' => '山田',
                'first_name' => '太郎',
                'user_number' => '001',
                'email' => 'yamada@example.com',
                'password' => Hash::make('password'),
                'is_admin' => true,
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'last_name' => '鈴木',
                'first_name' => '花子',
                'user_number' => '002',
                'email' => 'suzuki@example.com',
                'password' => Hash::make('password'),
                'is_admin' => false,
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'last_name' => '佐藤',
                'first_name' => '次郎',
                'user_number' => '003',
                'email' => 'sato@example.com',
                'password' => Hash::make('password'),
                'is_admin' => true,
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'last_name' => '田中',
                'first_name' => '三郎',
                'user_number' => '004',
                'email' => 'tanaka@example.com',
                'password' => Hash::make('password'),
                'is_admin' => false,
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'last_name' => '山口',
                'first_name' => '四郎',
                'user_number' => '005',
                'email' => 'yamaguchi@example.com',
                'password' => Hash::make('password'),
                'is_admin' => false,
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'last_name' => '松本',
                'first_name' => '五郎',
                'user_number' => '006',
                'email' => 'matsumoto@example.com',
                'password' => Hash::make('password'),
                'is_admin' => true,
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'last_name' => '渡辺',
                'first_name' => '六郎',
                'user_number' => '007',
                'email' => 'watanabe@example.com',
                'password' => Hash::make('password'),
                'is_admin' => false,
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 他のスタッフデータを追加できます
        ]);
    }
}
