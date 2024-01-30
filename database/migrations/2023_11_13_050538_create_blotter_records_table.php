<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlotterRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blotter_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('residentID');
            $table->foreign('residentID')->references('id')->on('residents')->onDelete('cascade')->onUpdate('cascade');
            $table->date('date');
            $table->longText('description');
            $table->unsignedBigInteger('officerID')->nullable();
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
        Schema::dropIfExists('blotter_records');
    }
}
