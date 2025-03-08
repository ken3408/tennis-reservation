<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('lesson_court_status', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_schedule_id')->constrained('lesson_schedules')->onDelete('cascade');
            $table->text('reason')->comment('レッスン不可理由');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lesson_court_status');
    }
};
