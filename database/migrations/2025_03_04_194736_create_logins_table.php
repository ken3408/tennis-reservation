<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logins', function (Blueprint $table) {
            $table->id(); // 主キー: 生徒ID
            $table->string('provider')->comment('認証プロバイダー'); // 認証プロバイダー (例: email, line)
            $table->string('identifier')->unique()->comment('プロバイダーの識別子'); // プロバイダー識別子 (例: メールアドレス、LINE ID)
            $table->string('password')->nullable()->comment('メールログイン用のパスワード'); // メールログイン用のパスワード
            $table->enum('user_type', ['student', 'staff'])->comment('ユーザータイプ'); // タイプ (例: student, staff)
            $table->unsignedBigInteger('user_id')->comment('ユーザーID'); // 生徒またはスタッフID
            $table->timestamps(); // created_at, updated_at

            // 外部キー制約を設定 (user_id が students または staff に依存する場合)
            // ユーザータイプに応じて適用範囲を制御するなら柔軟に対応が必要
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logins');
    }
}
