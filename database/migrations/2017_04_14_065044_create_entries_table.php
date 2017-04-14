<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('entries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('element_id');
            $table->string('serial');
            $table->integer('user_id');
            $table->integer('status_id');
            $table->integer('order_id')->nullable();
            $table->integer('departure_id')->nullable();
            $table->timestamps('freserve')->nullable();
            $table->timestamps('fdelivery')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('entries');
    }

}
