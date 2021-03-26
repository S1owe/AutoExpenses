<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maps', function (Blueprint $table) {
            $table->id();
            $table->string('from_name',255)->nullable('false');
            $table->string('to_name',255)->nullable('false');
            $table->string('from_n',255)->nullable('false');
            $table->string('from_e',255)->nullable('false');
            $table->string('to_n',255)->nullable('false');
            $table->string('to_e',255)->nullable('false');
            $table->integer('user_id')->nullable('false');
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
        Schema::dropIfExists('maps');
    }
}
