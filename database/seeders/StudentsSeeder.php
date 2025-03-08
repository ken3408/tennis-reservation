<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StudentsSeeder extends Seeder
{
    public function run()
    {
        DB::table('students')->insert([
            [
                'name' => '田中 太郎',
                'email' => 'tanaka@example.com',
                'line_id' => 'tanaka123',
                'level' => 3,
                'ticket_count' => 5,
                'ticket_expiry_date' => now()->addMonths(3),
                'status' => 2, // レギュラー
                'role_id' => 1, // 一般
                'password' => bcrypt('password123'), // パスワード
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '鈴木 花子',
                'email' => 'suzuki@example.com',
                'line_id' => 'suzuki456',
                'level' => 1,
                'ticket_count' => 0,
                'ticket_expiry_date' => null,
                'status' => 3, // 仮会員
                'role_id' => 2, // ジュニア
                'password' => bcrypt('password456'), // パスワード
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
