<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('logins', function (Blueprint $table) {
            $table->id(); // 主キー
            $table->string('provider')->comment('認証プロバイダー'); // 例: email, line
            $table->string('identifier')->unique()->comment('プロバイダーの識別子'); // メールアドレスまたはLINE ID
            $table->string('password')->nullable()->comment('メールログイン用のパスワード');
            $table->morphs('user'); // user_id & user_type のポリモーフィックカラム
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('logins');
    }
};
