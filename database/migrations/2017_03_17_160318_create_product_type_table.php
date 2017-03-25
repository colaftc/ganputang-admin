<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('product_types',function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name',64)->comment('产品类别名称');
			$table->text('remarks')->nullable()->comment('备注');
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('suppliers',function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name',64)->comment('商号');
			$table->string('address')->nullable()->comment('地址');
			$table->string('brand',64)->comment('品牌');
			$table->string('contact',32)->comment('联系人');
			$table->string('mobile',16)->comment('手机');
			$table->boolean('brandholder')->default(1)->comment('是否品牌持有者');
			$table->timestamps();
			$table->softDeletes();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::dropIfExists('product_types');
		Schema::dropIfExists('suppliers');
    }
}
