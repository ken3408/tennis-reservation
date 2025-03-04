<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_tickets', function (Blueprint $table) {
            $table->id(); // 生徒チケットID (主キー)
            $table->unsignedBigInteger('student_id')->comment('生徒ID'); // 生徒ID
            $table->unsignedBigInteger('ticket_type_id')->comment('チケット種別ID'); // チケット種別ID
            $table->integer('remaining_tickets')->default(0)->comment('残チケット数'); // 残チケット数
            $table->date('expiry_date')->comment('チケット有効期限'); // チケット有効期限
            $table->timestamps(); // created_at, updated_at

            // 外部キー制約
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('ticket_type_id')->references('id')->on('ticket_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_tickets');
    }
}
