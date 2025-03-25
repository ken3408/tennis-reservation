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
        'student_number' => 'F123456', // 生徒番号
        'name' => '田中 太郎',
        'email' => 'tanaka@example.com',
        'line_id' => 'tanaka123',
        'lesson_master_id' => 1, // レッスンマスターID
        'ticket_count' => 5,
        'ticket_expiry_date' => now()->addMonths(3),
        'status' => 2, // レギュラー
        'role_id' => 1, // 一般
        'password' => bcrypt('password123'), // パスワード
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'student_number' => 'F654321', // 生徒番号
        'name' => '鈴木 花子',
        'email' => 'suzuki@example.com',
        'line_id' => 'suzuki456',
        'lesson_master_id' => null, // レッスンマスターID
        'ticket_count' => 0,
        'ticket_expiry_date' => null,
        'status' => 3, // 仮会員
        'role_id' => 2, // ジュニア
        'password' => bcrypt('password456'), // パスワード
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'student_number' => 'F123457',
        'name' => '佐藤 一郎',
        'email' => 'sato@example.com',
        'line_id' => 'sato123',
        'lesson_master_id' => 2,
        'ticket_count' => 3,
        'ticket_expiry_date' => now()->addMonths(2),
        'status' => 2,
        'role_id' => 1,
        'password' => bcrypt('password789'),
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'student_number' => 'F123458',
        'name' => '高橋 次郎',
        'email' => 'takahashi@example.com',
        'line_id' => 'takahashi123',
        'lesson_master_id' => 3,
        'ticket_count' => 7,
        'ticket_expiry_date' => now()->addMonths(4),
        'status' => 2,
        'role_id' => 1,
        'password' => bcrypt('password321'),
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'student_number' => 'F123459',
        'name' => '中村 三郎',
        'email' => 'nakamura@example.com',
        'line_id' => 'nakamura123',
        'lesson_master_id' => 1,
        'ticket_count' => 5,
        'ticket_expiry_date' => now()->addMonths(3),
        'status' => 2,
        'role_id' => 1,
        'password' => bcrypt('password654'),
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'student_number' => 'F123460',
        'name' => '小林 四郎',
        'email' => 'kobayashi@example.com',
        'line_id' => 'kobayashi123',
        'lesson_master_id' => 2,
        'ticket_count' => 4,
        'ticket_expiry_date' => now()->addMonths(2),
        'status' => 2,
        'role_id' => 1,
        'password' => bcrypt('password987'),
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'student_number' => 'F123461',
        'name' => '山本 五郎',
        'email' => 'yamamoto@example.com',
        'line_id' => 'yamamoto123',
        'lesson_master_id' => 3,
        'ticket_count' => 8,
        'ticket_expiry_date' => now()->addMonths(5),
        'status' => 2,
        'role_id' => 1,
        'password' => bcrypt('password111'),
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'student_number' => 'F123462',
        'name' => '伊藤 六郎',
        'email' => 'ito@example.com',
        'line_id' => 'ito123',
        'lesson_master_id' => 1,
        'ticket_count' => 6,
        'ticket_expiry_date' => now()->addMonths(3),
        'status' => 2,
        'role_id' => 1,
        'password' => bcrypt('password222'),
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'student_number' => 'F123463',
        'name' => '松本 七郎',
        'email' => 'matsumoto@example.com',
        'line_id' => 'matsumoto123',
        'lesson_master_id' => 2,
        'ticket_count' => 3,
        'ticket_expiry_date' => now()->addMonths(2),
        'status' => 2,
        'role_id' => 1,
        'password' => bcrypt('password333'),
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'student_number' => 'F123464',
        'name' => '加藤 八郎',
        'email' => 'kato@example.com',
        'line_id' => 'kato123',
        'lesson_master_id' => 3,
        'ticket_count' => 7,
        'ticket_expiry_date' => now()->addMonths(4),
        'status' => 2,
        'role_id' => 1,
        'password' => bcrypt('password444'),
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'student_number' => 'F123465',
        'name' => '森田 九郎',
        'email' => 'morita@example.com',
        'line_id' => 'morita123',
        'lesson_master_id' => 1,
        'ticket_count' => 5,
        'ticket_expiry_date' => now()->addMonths(3),
        'status' => 2,
        'role_id' => 1,
        'password' => bcrypt('password555'),
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'student_number' => 'F123466',
        'name' => '藤田 十郎',
        'email' => 'fujita@example.com',
        'line_id' => 'fujita123',
        'lesson_master_id' => 2,
        'ticket_count' => 4,
        'ticket_expiry_date' => now()->addMonths(2),
        'status' => 2,
        'role_id' => 1,
        'password' => bcrypt('password666'),
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }
}
