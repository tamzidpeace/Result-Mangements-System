<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('subject_id');
            $table->integer('student_id');
            $table->string('year');
            $table->decimal('tt1',8,2)->nullable();
            $table->decimal('tt2',8,2)->nullable();
            $table->decimal('tt3',8,2)->nullable();
            $table->decimal('ttt',8,2)->nullable();
            $table->decimal('part_a',8,2)->nullable();
            $table->decimal('part_b',8,2)->nullable();
            $table->decimal('attendance')->nullable();
            $table->decimal('total')->nullable();
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
        Schema::dropIfExists('marks');
    }
}
