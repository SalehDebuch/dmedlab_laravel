<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTubesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tubes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tube_name');

            $table->integer('language_id')->unsigned()->index()->default(2); // default is english language
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');

            $table->string('color', 25);
            $table->string('color_name', 255)->nullable();
            $table->text('img')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tubes');
    }
}
