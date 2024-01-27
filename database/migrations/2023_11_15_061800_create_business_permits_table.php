<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessPermitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_permits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('residentID');
            $table->foreign('residentID')->references('id')->on('residents')->onDelete('cascade')->onUpdate('cascade');
            $table->string('businessName');
            $table->string('businessAddress');
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
        Schema::dropIfExists('business_permits');
    }
}
