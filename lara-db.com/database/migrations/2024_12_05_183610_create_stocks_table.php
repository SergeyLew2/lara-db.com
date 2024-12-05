<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->date('last_change_date')->nullable();
            $table->string('supplier_article', 30)->nullable();
            $table->string('tech_size', 30)->nullable();
            $table->integer('barcode')->nullable();
            $table->integer('quantity')->nullable();
            $table->boolean('is_supply')->nullable();
            $table->boolean('is_realization')->nullable();
            $table->integer('quantity_full')->nullable();
            $table->string('warehouse_name', 250)->nullable();
            $table->integer('in_way_to_client')->nullable();
            $table->integer('in_way_from_client')->nullable();
            $table->integer('nm_id')->nullable();
            $table->string('subject', 30)->nullable();
            $table->string('category', 30)->nullable();
            $table->string('brand', 30)->nullable();
            $table->integer('sc_code')->nullable();
            $table->string('price', 30)->nullable();
            $table->string('discount', 30)->nullable();     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
