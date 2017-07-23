<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('customers',function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('tid')->unique()->comment('淘宝ID')->nullable();
			$table->string('name')->comment('姓名');
			$table->string('mobile')->comment('手机');
			$table->string('addr')->comment('地址');
			$table->string('remarks')->nullable()->comment('备注');
			$table->string('reffer')->nullable()->comment('来源');
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
		Schema::dropIfExists('customers');
    }
}
