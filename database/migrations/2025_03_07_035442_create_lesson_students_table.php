<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('lesson_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_schedule_id')->constrained('lesson_schedules')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->enum('status', ['RESERVED', 'CANCELLED'])->comment('予約状態');
            $table->timestamps();

            // 同じ生徒が同じレッスンを重複予約できないようにする
            $table->unique(['lesson_schedule_id', 'student_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('lesson_students');
    }
};
