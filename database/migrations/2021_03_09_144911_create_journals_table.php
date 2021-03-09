<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('project_id')->index()->comment('项目ID');
            $table->uuid('environment_id')->index()->comment('环境ID');
            $table->uuid('operator_id')->index()->comment('操作人员ID');
            $table->string('operator_type')->index()->comment('操作人员模型');
            $table->string('resource_id')->index()->comment('资源ID');
            $table->string('resource_type')->index()->comment('资源模型');
            $table->string('action')->comment('操作类型');
            $table->json('query')->nullable()->comment('查询参数');
            $table->json('body')->nullable()->comment('请求体');
            $table->string('uri')->index()->comment('URI');
            $table->json('origin')->nullable()->comment('原始数据');
            $table->json('modified')->nullable()->comment('改动数据');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('journals');
    }
}
