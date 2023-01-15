<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanStoresBrandNearMeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_stores_brand_near_me', function (Blueprint $table) {
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
            $table->longText('standard_brand_name')->nullable();
            $table->longText('state_brand_list')->nullable();
            $table->longText('popular_city_brand')->nullable();
            $table->longText('page_info')->nullable();
            $table->string('page')->nullable();
            $table->string('brand_name')->nullable();
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
        Schema::dropIfExists('loan_stores_brand_near_me');
    }
}
