<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('g_number', 30);
            $table->dateTime('date');
            $table->date('last_change_date');
            $table->string('supplier_article', 30);
            $table->string('tech_size', 30);
            $table->integer('barcode');
            $table->string('total_price', 30);
            $table->integer('discount_percent');
            $table->string('warehouse_name', 250);
            $table->string('oblast', 240);
            $table->integer('income_id');
            $table->string('odid', 30)->nullable();
            $table->integer('nm_id');
            $table->string('subject', 30);
            $table->string('category', 30);
            $table->string('brand', 30);
            $table->boolean('is_cancel')->nullable();
            $table->date('cancel_dt')->nullable();        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
