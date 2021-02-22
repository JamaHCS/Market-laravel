<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_details', function (Blueprint $table) {
            $table->id();

            $table->float('quant');
            $table->float('total');

            $table->bigInteger('sell_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();

            $table->foreign('sell_id')->references('id')->on('sells');
            $table->foreign('product_id')->references('id')->on('products');

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
        Schema::dropIfExists('sell_details');
    }
}
