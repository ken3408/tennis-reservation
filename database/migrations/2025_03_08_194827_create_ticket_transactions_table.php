<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_transactions', function (Blueprint $table) {
            $table->id(); // チケット履歴ID (主キー)
            $table->unsignedBigInteger('student_ticket_id')->comment('生徒チケットID'); // 生徒チケットID
            $table->unsignedBigInteger('lesson_student_record_id')->nullable()->comment('レッスンID'); // レッスンID (NULL許可)
            $table->enum('transaction_type', ['purchase', 'use'])->comment('トランザクション種別'); // トランザクション種別
            $table->integer('ticket_change')->comment('チケット変動数'); // チケットの増減（購入は正の値、消費は負の値）
            $table->timestamps(); // created_at, updated_at

            // 外部キー制約
            $table->foreign('student_ticket_id')->references('id')->on('student_tickets')->onDelete('cascade');
            $table->foreign('lesson_student_record_id')->references('id')->on('lesson_student_records')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_transactions');
    }
}
