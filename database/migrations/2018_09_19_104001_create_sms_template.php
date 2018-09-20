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
        Schema::connection('central')->create($this->table, function (Blueprint $table) {
                $table->increments('id');
                $table->string('content', 255)->nullable()->comment('短信模板內容');
                $table->timestamp('updated_at');
                $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->softDeletes()->comment('無效|空號');
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
        Schema::connection('central')->dropIfExists($this->table);
    }
}
