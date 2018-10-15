<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsAccount extends Migration
{
    private $table = 'sms_account';

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

                $table->string('key', 255)->comment('廠商的 apikey');
                $table->string('secret_key', 255)->comment('某些廠商可能會有 secret_key');
                $table->string('account', 255)->comment('帳號名稱');
                $table->string('provider', 255)->comment('廠商名稱');
                $table->string('remark', 255)->comment('備註');
 
                $table->unsignedTinyInteger('status')->default('1')->comment('狀態 0 禁用,1 啟動, 2 尚未發送');
                
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
