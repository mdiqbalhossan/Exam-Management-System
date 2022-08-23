<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('batch_id');
            $table->enum('type',['Combined Exam','Chapter Wise Exam','Subject Wise Exam']);
            $table->text('description');
            $table->string('duration');
            $table->string('total_marks');
            $table->string('total_question');
            $table->string('negative_marks');
            $table->string('pass_percentage');
            $table->tinyInteger('status');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('exam_type',['Paid','Free']);
            $table->timestamps();

            $table->foreign('batch_id')->references('id')->on('exam_batches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
}
