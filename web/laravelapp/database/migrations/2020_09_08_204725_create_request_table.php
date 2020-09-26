<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request', function (Blueprint $table) {
            $table->integer('time_id');
            $table->integer('time_no');
            $table->string('week');
            $table->integer('club_id');

            $table->primary(['time_id','time_no', 'week','club_id']);
            $table->foreign('time_id')
            ->references('id')->on('time_table')
            ->onDelete('cascade');
            $table->foreign('club_id')
            ->references('id')->on('club')
            ->onDelete('cascade');
            $table->foreign(['time_id','time_no','week'])
            ->references(['time_id','time_no','week'])->on('time_details')
            ->onDelete('cascade');

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
        Schema::dropIfExists('request');
    }
}
