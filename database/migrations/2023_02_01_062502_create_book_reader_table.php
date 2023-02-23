<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookReaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_reader', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reader_id');
            $table->unsignedBigInteger('book_id');
            $table->integer('count')->default(0);
            $table->timestamps();

            $table->foreign('reader_id')->references('id')->on('readers')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('book_reader', function (Blueprint $table) {
            $table->dropForeign(['reader_id']);
            $table->dropForeign(['book_id']);
        });

        Schema::dropIfExists('book_reader');
    }
}

