<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanStoreTypeBrandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_store_type_brand', function (Blueprint $table) {
            $table->id();
            $table->string('_id');
            $table->string('title', 600);
            $table->string('alias', 200);
            $table->string('pic');
            $table->string('services');
            $table->string('rating');
            $table->smallInteger('enable');
            $table->string('reviews');
            $table->string('type', 200);
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
        Schema::dropIfExists('loan_store_type_brand');
    }
}
