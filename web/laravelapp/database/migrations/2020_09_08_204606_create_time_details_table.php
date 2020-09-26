<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('time_details', function (Blueprint $table) {
            $table->integer('time_id')->unsigned();
            $table->integer('time_no');
            $table->string('week');
            $table->integer('club_id');
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();

            $table->primary(['time_id','time_no', 'week']);

            $table->foreign('time_id')
            ->references('id')->on('time_table')
            ->onDelete('cascade');
            $table->foreign('club_id')
            ->references('id')->on('club')
            ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_details');
    }
}
