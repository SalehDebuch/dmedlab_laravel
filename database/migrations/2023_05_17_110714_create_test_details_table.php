<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_details', function (Blueprint $table) {
            $table->id();

            $table->integer('test_id')->unsigned()->index();
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');

            $table->bigInteger('parent_id')->unsigned()->index()->nullable();
            $table->foreign('parent_id')->references('id')->on('test_details')->onDelete('cascade');

            $table->integer('language_id')->unsigned()->index()->nullable();
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');

            $table->integer('input_type')->unsigned()->index();
            $table->foreign('input_type')->references('id')->on('input_types')->onDelete('cascade');

            $table->string('title', 250);
            $table->string('indentation', 250);

            $table->integer('align_id')->unsigned()->index();
            $table->foreign('align_id')->references('id')->on('aligns')->onDelete('cascade');


            $table->text('content');
            $table->smallInteger('order')->default(0);
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
        Schema::dropIfExists('test_details');
    }
}
