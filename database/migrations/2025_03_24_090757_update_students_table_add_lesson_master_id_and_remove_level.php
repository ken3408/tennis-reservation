<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStudentsTableAddLessonMasterIdAndRemoveLevel extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('students', function (Blueprint $table) {
      // lesson_master_idを追加
      $table->unsignedBigInteger('lesson_master_id')->nullable()->after('line_id')->comment('レッスンマスターID');

      // 外部キー制約を追加
      $table->foreign('lesson_master_id')
        ->references('id')
        ->on('lesson_master')
        ->onDelete('set null')
        ->onUpdate('cascade'); // onUpdateを追加

      // levelカラムを削除
      $table->dropColumn('level');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('students', function (Blueprint $table) {
      // lesson_master_idを削除
      $table->dropForeign(['lesson_master_id']);
      $table->dropColumn('lesson_master_id');

      // levelカラムを再追加
      $table->integer('level')->default(1)->after('line_id');
    });
  }
}
