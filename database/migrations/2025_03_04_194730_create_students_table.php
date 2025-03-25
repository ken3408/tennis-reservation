<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('students', function (Blueprint $table) {
      $table->id(); // 生徒ID (自動増分主キー)
      $table->string('student_number')->unique()->comment('生徒番号'); // 生徒番号
      $table->string('name'); // 生徒氏名
      $table->string('email')->unique(); // メールアドレス (ユニーク)
      $table->string('line_id')->nullable(); // LINE ID (NULL許可)
      // lesson_master_idを追加
      $table->unsignedBigInteger('lesson_master_id')->nullable()->comment('レッスンマスターID');
      $table->foreign('lesson_master_id')->references('id')->on('lesson_master')->onDelete('set null'); // 外部キー制約
      $table->integer('ticket_count')->default(0); // チケット数
      $table->date('ticket_expiry_date')->nullable(); // チケット有効期限 (NULL許可)
      $table->tinyInteger('status')->default(3)->comment('0: 退会, 1: 休会, 2: レギュラー, 3: 仮会員'); // ステータス
      $table->unsignedBigInteger('role_id')->comment('1: 一般, 2: ジュニア'); // 権限ID
      $table->string('password'); // パスワード
      $table->timestamps(); // created_at, updated_at
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('students');
  }
}
