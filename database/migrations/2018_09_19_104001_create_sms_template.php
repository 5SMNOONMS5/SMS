<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsTemplate extends Migration
{
    private $table = 'sms_template';

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

                $table->integer('account_id')->comment('帳號的 id');          
                $table->integer('provider_template_id')->comment('廠商上的模板 id ');          

                $table->string('content', 255)->comment('短信模板內容');
                $table->string('rule', 20)->comment('變數內容，用，分隔');
                $table->string('sign', 10)->nullable()->comment('簽名檔');

                $table->timestamp('updated_at');
                $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->softDeletes()->comment('可能被禁用的模板');
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
