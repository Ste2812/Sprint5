<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plays', function(Blueprint $table) {
            $table->id();
            $table->integer('dice_one');
            $table->integer('dice_two');
            $table->integer('points');
            $table->string('result');
            $table->timestamps();

            $table->foreignId('user_id')->unsigned()->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plays');
    }
};
