<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('tborders',function(Blueprint $table)
		{
			$table->bigInteger('id')->primary()->comment('订单号');
			$table->decimal('price',6,2)->comment('实付金额');
			$table->string('status')->comment('订单状态');
			$table->string('remarks')->nullable()->comment('备注');
			$table->string('message')->nullable()->comment('留言');
			$table->string('exp_no')->nullable()->comment('快递单号');
			$table->string('exp_com')->nullable()->comment('快递公司');
			$table->datetime('buytime')->comment('拍下时间');
			$table->datetime('paytime')->comment('付款时间');
			$table->integer('total_count')->unsigned()->comment('商品总件数');
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
		Schema::dropIfExists('tborders');
    }
}
