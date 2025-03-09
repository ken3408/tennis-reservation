<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lesson_schedule_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_schedule_id')->constrained('lesson_schedules')->onDelete('cascade')->comment('レッスンID');
            $table->foreignId('staff_id')->constrained('staff')->onDelete('cascade')->comment('メインコーチID');
            $table->boolean('is_main_substituted')->default(false)->comment('メインコーチ代行フラグ');
            $table->foreignId('sub_staff_id')->nullable()->constrained('staff')->onDelete('set null')->comment('サブコーチID (基本NULL)');
            $table->boolean('is_sub_substituted')->default(false)->comment('サブコーチ代行フラグ');
            $table->date('date')->comment('対象日');
            $table->integer('reserved_count')->default(0)->comment('予約人数');
            $table->integer('cancelled_count')->default(0)->comment('キャンセル人数');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_schedule_details');
    }
};
