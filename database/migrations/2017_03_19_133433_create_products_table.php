<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('products',function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->comment('产品名称');
			$table->string('spec')->comment('规格');
			$table->decimal('in_price',6,2)->comment('进价');
			$table->decimal('out_price',6,2)->nullable()->comment('指导零售价');
			$table->decimal('out_wholesaleprice',6,2)->nullable()->comment('指导批发价');
			$table->integer('type_id')->unsigned()->comment('类别');
			$table->integer('supplier_id')->unsigned()->comment('类别');
			$table->string('remarks')->comment('备注');
			$table->timestamps();
			$table->softDeletes();
			$table->foreign('type_id')->references('id')->on('product_types')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade')->onUpdate('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::disableForeignKeyConstraints();
		Schema::dropIfExists('products');
		Schema::enableForeignKeyConstraints();
    }
}
