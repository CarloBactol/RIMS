<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlottersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blotters', function (Blueprint $table) {
            $table->id();    
            $table->longText("description");    
            $table->unsignedBigInteger('complainant_id')->nullable();
            $table->unsignedBigInteger('respondent_id')->nullable();
            $table->foreign('complainant_id')->references('id')->on('people')->onDelete('cascade');
            $table->foreign('respondent_id')->references('id')->on('people')->onDelete('cascade');
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
        Schema::table('blotters', function (Blueprint $table) {
            $table->dropForeign(['complainant_id']);
            $table->dropForeign(['respondent_id']);
            $table->dropColumn('complainant_id');
            $table->dropColumn('respondent_id');
        });
    }
}
