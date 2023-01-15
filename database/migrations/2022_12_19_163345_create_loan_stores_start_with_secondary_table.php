<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanStoresStartWithSecondaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_stores_start_with_secondary', function (Blueprint $table) {
            $table->id();
            $table->integer('group_id');
            $table->longText('title');
            $table->longText('lower_title');
            $table->string('initials_first_name',200);
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
        Schema::dropIfExists('loan_stores_start_with_secondary');
    }
}
