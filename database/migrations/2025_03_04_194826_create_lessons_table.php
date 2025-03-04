<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id(); // ID (主キー)
            $table->unsignedBigInteger('lesson_category_id')->comment('レッスンカテゴリーID'); // レッスンカテゴリーID
            $table->integer('court_num')->comment('コート番号'); // コート番号
            $table->year('year')->comment('年 (YYYY)'); // 年 (YYYY)
            $table->tinyInteger('month')->comment('月 (MM)'); // 月 (MM)
            $table->tinyInteger('day')->comment('日 (DD)'); // 日 (DD)
            $table->boolean('court_status')->default(false)->comment('コート状態 (雨：1, 晴れ：0)'); // コート状態
            $table->unsignedBigInteger('substitute_staff_id')->nullable()->comment('サブコーチID'); // サブコーチID
            $table->boolean('is_substitute')->default(false)->comment('代行の場合 = true'); // 代行フラグ
            $table->timestamps(); // created_at, updated_at

            // 外部キー制約
            $table->foreign('lesson_category_id')->references('id')->on('lesson_categories')->onDelete('cascade');
            $table->foreign('substitute_staff_id')->references('id')->on('staff')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons');
    }
}
