<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
	public function products()
	{
		return $this->hasMany('App\Product','type_id');
	}

	public function __toString()
	{
		return $this->name;
	}
}
