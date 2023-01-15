<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanStoreTypeDirectoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_store_type_directory', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('group_id');
            $table->string('initials_first_name', 200);
            $table->string('title_start', 600);
            $table->string('title_end', 600);
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
        Schema::dropIfExists('loan_store_type_directory');
    }
}
