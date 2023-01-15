<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanStoresBrandNearMeFoundTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_stores_brand_near_me_found', function (Blueprint $table) {
            $table->id();
            $table->string('_id')->nullable();
            $table->longText('title')->nullable();
            $table->longText('pic')->nullable();
            $table->longText('services')->nullable();
            $table->string('rating')->nullable();
            $table->string('enable')->nullable();
            $table->string('reviews')->nullable();
            $table->string('type')->nullable();
            $table->longText('brand_path')->nullable();
            $table->integer('brand_number')->nullable();
            $table->longText('standard_brand_name')->nullable();
            $table->integer('store_count')->nullable();
            $table->string('state_short_name')->nullable();
            $table->string('state')->nullable();
            $table->longText('brand_title')->nullable();
            $table->longText('loan_brand_city_list')->nullable();
            $table->longText('loan_brand_main_city')->nullable();
            $table->longText('page_info')->nullable();
            $table->string('page')->nullable();
            $table->string('query_brand_name')->nullable();
            $table->string('query_state')->nullable();
            $table->string('build_id')->nullable();
            $table->string('asset_prefix')->nullable();
            $table->string('is_fallback')->nullable();
            $table->string('gssp')->nullable();
            $table->string('custom_server')->nullable();
            $table->string('script_loader')->nullable();
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
        Schema::dropIfExists('loan_stores_brand_near_me_found');
    }
}
