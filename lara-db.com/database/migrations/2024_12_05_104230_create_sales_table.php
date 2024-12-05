<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('g_number', 30);
            $table->date('date');
            $table->date('last_change_date');
            $table->string('supplier_article', 30);
            $table->string('tech_size', 30);
            $table->integer('barcode');
            $table->string('total_price', 30);
            $table->string('discount_percent', 30);
            $table->boolean('is_supply');

            $table->boolean('is_realization');
            $table->string('promo_code_discount', 30)->nullable();
            $table->string('warehouse_name', 250);
            $table->string('country_name', 30);
            $table->string('oblast_okrug_name', 240);
            $table->string('region_name', 250);

            $table->integer('income_id');
            $table->string('sale_id', 30);
            $table->string('odid', 30)->nullable();
            $table->string('spp', 30);
            $table->string('for_pay', 30);
            $table->string('finished_price', 30);

            $table->string('price_with_disc', 30);
            $table->integer('nm_id');
            $table->string('subject', 30);
            $table->string('category', 30);
            $table->string('brand', 30);
            $table->boolean('is_storno')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
