<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTborderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('tborder_products',function(Blueprint $table)
		{
			$table->increments('id');
			$table->bigInteger('oid')->comment('订单号');
			$table->string('title')->comment('标题');
			$table->string('code')->nullable()->comment('商家编码');
			$table->integer('quantity')->comment('数量');
			$table->timestamps();

			$table->foreign('oid')->references('id')->on('tborders')->onDelete('cascade')->onUpdate('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::dropIfExists('tborder_products');
    }
}
