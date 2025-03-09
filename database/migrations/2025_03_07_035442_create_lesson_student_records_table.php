<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('lesson_student_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_schedule_detail_id')->constrained('lesson_schedule_details')->onDelete('cascade')->comment('レッスン詳細ID (当日のレッスン)');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade')->comment('生徒ID');
            $table->enum('status', ['RESERVED', 'CANCELLED'])->comment('予約状態');
            $table->date('action_date')->comment('予約・キャンセル日');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lesson_student_records');
    }
};
