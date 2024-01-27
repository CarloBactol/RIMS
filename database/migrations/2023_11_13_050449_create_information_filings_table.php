<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformationFilingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('information_filings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('residentID');
            $table->foreign('residentID')->references('id')->on('residents')->onDelete('cascade')->onUpdate('cascade');
            $table->date('filingDate');
            $table->string('filingType');
            $table->text('description');
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
        Schema::dropIfExists('information_filings');
    }
}
