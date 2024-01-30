<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('civilStatus')->nullable();
            $table->string('nationality')->nullable();
            $table->integer('age')->nullable();
            $table->date('dateOfBirth')->nullable();
            $table->string('address');
            $table->string('contactNumber')->nullable();
            $table->string('gender');
            $table->string('barangay')->default('Quibaol');
            $table->string('purpose')->nullable();
            $table->boolean('isBlotter')->default(false);
            $table->string('status')->default(0);
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
        Schema::dropIfExists('residents');
    }
}
