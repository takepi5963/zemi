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
        Schema::create('time_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('time_id')->unsigned()
                ->constrained()
                ->cascadeOnDelete()  // ON DELETE で CASCADE
                ->cascadeOnUpdate(); // ON UPDATE で CASCADE;
            $table->integer('time_no');
            $table->integer('week');
            $table->integer('club_id')->unsigned()->nullable();
            $table->time('start_time');
            $table->time('end_time');
            $table->foreign('time_id')->references('id')->on('time')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('club_id')->references('id')->on('club')
            ->onDelete('cascade')
            ->onUpdate('cascade');;
            $table->unique(['time_id', 'time_no','week'],'uq_roles'); 
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
        Schema::dropIfExists('time_details');
    }
}
