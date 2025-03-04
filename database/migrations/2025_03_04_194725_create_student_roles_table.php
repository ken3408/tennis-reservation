<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_roles', function (Blueprint $table) {
            $table->id('role_id'); // ロールID (主キー)
            $table->string('role_name')->comment('ロール名: 管理者、コーチ、フロントスタッフ'); // ロール名
            $table->integer('permission_level')->comment('権限レベル'); // 権限レベル
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_roles');
    }
}
