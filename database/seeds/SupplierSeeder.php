<?php

use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		factory('App\ProductType',10)->create();
		factory('App\Supplier',30)->create()->each(function($s){
			$s->products()->save(factory('App\Product')->make());
			$s->products()->save(factory('App\Product')->make());
			$s->products()->save(factory('App\Product')->make());
			$s->products()->save(factory('App\Product')->make());
			$s->products()->save(factory('App\Product')->make());
			$s->products()->save(factory('App\Product')->make());
			$s->products()->save(factory('App\Product')->make());
			$s->products()->save(factory('App\Product')->make());
		});
    }
}
