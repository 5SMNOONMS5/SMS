<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsLog extends Migration
{
    private $table = 'sms_log';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
        // Schema::connection('central')->create($this->table, function (Blueprint $table) {
                $table->increments('id');
                $table->integer('telephone_id')->unsigned()->default('0')->comment('電話 id');

                $table->integer('fee')->comment('電話費用');                
                $table->integer('admin_id')->comment('發送者');
                $table->integer('account_id')->comment('發送帳號 id');
                
                $table->string('content', 255)->comment('發送內容');
                $table->string('phone', 32)->comment('電話號碼加密');
                
                $table->unsignedTinyInteger('department')->default('1')->comment('0 系統,1 電銷');
                $table->unsignedTinyInteger('status')->default('2')->comment('發送狀態 0 失敗,1 成功, 2 尚未發送');
                
                $table->timestamp('updated_at');
                $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table);
        // Schema::connection('central')->dropIfExists($this->table);
    }
}
