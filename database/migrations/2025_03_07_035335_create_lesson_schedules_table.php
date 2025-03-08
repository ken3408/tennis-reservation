<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('lesson_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_master_id')->constrained('lesson_master')->onDelete('cascade');
            $table->char('year_month', 6)->comment('年月 (YYYYMM)');
            $table->enum('weekday', ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'])->comment('曜日');
            $table->time('start_time')->comment('開始時間');
            $table->time('end_time')->comment('終了時間');
            $table->integer('court_num')->comment('コート番号');
            $table->foreignId('staff_id')->constrained('staff')->onDelete('cascade')->comment('メインコーチ');
            $table->foreignId('sub_staff_id')->nullable()->constrained('staff')->onDelete('set null')->comment('サブコーチ');
            $table->tinyInteger('max_participants')->comment('最大人数');
            $table->tinyInteger('current_participants')->default(0)->comment('現在の予約人数');
            $table->enum('status', ['OPEN', 'CLOSED', 'CANCELLED'])->comment('レッスンの状態');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lesson_schedules');
    }
};
