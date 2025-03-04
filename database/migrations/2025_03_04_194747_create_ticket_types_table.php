<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_types', function (Blueprint $table) {
            $table->id(); // チケット種別ID (自動増分主キー)
            $table->string('name')->comment('チケット種別名'); // チケット種別名
            $table->integer('max_tickets')->default(0)->comment('最大チケット数'); // 最大チケット数
            $table->integer('validity_days')->default(0)->comment('有効日数（単位: 日）'); // 有効日数
            $table->text('description')->nullable()->comment('説明'); // 説明（NULL許可）
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
        Schema::dropIfExists('ticket_types');
    }
}
