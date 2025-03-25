<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('lesson_master', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->comment('レッスン名');
            $table->tinyInteger('level')->comment('レッスンレベル (1～9)');
            $table->tinyInteger('category')->comment('1: 一般, 2: ジュニア');
            $table->tinyInteger('max_participants')->comment('最大人数');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lesson_master');
    }
};
