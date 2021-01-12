<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('description')->nullable();
            $table->ipAddress('ip');
            $table->unsignedInteger('port')->nullable()->comment('SSH port');
            $table->string('username')->nullable()->comment('SSH username');
            $table->string('password')->nullable()->comment('SSH password');
            $table->unsignedInteger('core')->nullable();
            $table->unsignedInteger('memory')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servers');
    }
}
