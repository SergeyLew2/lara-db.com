<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->integer('income_id');
            $table->string('number', 30);
            $table->date('date');
            $table->date('last_change_date');
            $table->string('supplier_article', 30);
            $table->string('tech_size', 30);
            $table->integer('barcode');
            $table->integer('quantity');
            $table->string('total_price', 30);
            $table->date('date_close');
            $table->string('warehouse_name', 250);
            $table->integer('nm_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incomes');
    }
}
