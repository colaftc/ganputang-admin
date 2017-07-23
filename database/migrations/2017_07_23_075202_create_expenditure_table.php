<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpenditureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('expenditure',function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title')->comment('支出名目');
			$table->string('remarks')->nullable()->comment('备注');
			$table->integer('type_id')->unsigned()->comment('类别');
			$table->integer('shop_id')->unsigned()->nullable()->comment('所用店铺');
			$table->decimal('amount',6,2)->comment('金额');
			$table->date('paydate')->comment('支付日期');
			$table->boolean('was_paid')->default(true)->comment('是否已付清');
			$table->boolean('has_receipt')->default(false)->comment('是否有凭据');
			$table->timestamps();

			$table->foreign('shop_id')->references('id')->on('shop')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('type_id')->references('id')->on('expenses_type')->onDelete('cascade')->onUpdate('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::dropIfExists('expenditure');
    }
}
