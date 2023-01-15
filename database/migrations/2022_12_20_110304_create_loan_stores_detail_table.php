<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanStoresDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_stores_detail', function (Blueprint $table) {
            $table->id();
            $table->string('_id')->nullable();
            $table->string('data_id')->nullable();
            $table->longText('title')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->string('street_suffix')->nullable();
            $table->string('zip')->nullable();
            $table->string('phone')->nullable();
            $table->longText('address')->nullable();
            $table->longText('opening_hours')->nullable();
            $table->string('gps_coordinates')->nullable();
            $table->longText('location')->nullable();
            $table->string('website')->nullable();
            $table->string('rating')->nullable();
            $table->string('review_num')->nullable();
            $table->longText('services')->nullable();
            $table->string('category')->nullable();
            $table->longText('description')->nullable();
            $table->longText('photos')->nullable();
            $table->integer('enable')->nullable();
            $table->longText('lower_title')->nullable();
            $table->string('score')->nullable();
            $table->longText('loan_services')->nullable();
            $table->string('city_url')->nullable();
            $table->string('short_state')->nullable();
            $table->integer('available')->nullable();
            $table->string('main_type')->nullable();
            $table->integer('exist')->nullable();
            $table->string('initials')->nullable();
            $table->integer('open')->nullable();
            $table->string('short_name')->nullable();
            $table->longText('short_title')->nullable();
            $table->longText('reviews')->nullable();
            $table->longText('brandNearby')->nullable();
            $table->longText('nearByLoans')->nullable();
            $table->integer('redirect')->nullable();
            $table->longText('page_info')->nullable();
            $table->integer('socialBool')->nullable();
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
        Schema::dropIfExists('loan_stores_detail');
    }
}
