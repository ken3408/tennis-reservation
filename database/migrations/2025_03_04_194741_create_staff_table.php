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
            $table->string('name')->comment('スタッフ名前'); // スタッフ名前
            $table->unsignedBigInteger('staff_role_id')->comment('ロールID'); // ロールID
            $table->timestamps(); // created_at, updated_at

            // 外部キー制約
            $table->foreign('staff_role_id')->references('role_id')->on('student_roles')->onDelete('cascade');
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
