<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_categories', function (Blueprint $table) {
            $table->id(); // ID (主キー)
            $table->string('name')->comment('レッスンカテゴリー名'); // レッスンカテゴリー名
            $table->integer('duration')->comment('レッスン時間 (分)'); // レッスン時間
            $table->integer('max_participants')->default(1)->comment('最大人数'); // 最大人数
            $table->string('year_month', 7)->comment('年月 (YYYY-MM)'); // 年月 (例: 2024-12)
            $table->string('weekday')->comment('曜日'); // 曜日 (例: 月曜日)
            $table->time('start_time')->comment('開始時間'); // 開始時間
            $table->time('end_time')->comment('終了時間'); // 終了時間
            $table->enum('status', ['active', 'inactive'])->default('active')->comment('クラスステータス'); // クラスステータス
            $table->unsignedBigInteger('staff_id')->comment('メインコーチID'); // メインコーチID
            $table->timestamps(); // created_at, updated_at

            // 外部キー制約
            $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lesson_categories');
    }
}
