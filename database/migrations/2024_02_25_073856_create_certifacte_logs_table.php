<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertifacteLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certifacte_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('residentID');
            $table->foreign('residentID')->references('id')->on('residents')->onDelete('cascade')->onUpdate('cascade');
            $table->string("certificate_type");
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
        Schema::dropIfExists('certifacte_logs');
    }
}
