<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id(); // スタッフID (主キー)
            $table->string('last_name')->comment('スタッフ名字'); // スタッフ名字
            $table->string('first_name')->comment('スタッフ名前'); // スタッフ名前
            $table->string('user_number')->unique()->comment('ユーザー番号'); // ユーザー番号
            $table->string('email')->unique()->comment('メールアドレス'); // メールアドレス
            $table->string('password')->comment('パスワード'); // パスワード
            $table->unsignedBigInteger('role_id')->comment('ロールID'); // ロールID
            $table->timestamps(); // created_at, updated_at

            // 外部キー制約
            $table->foreign('role_id')->references('id')->on('staff_roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
