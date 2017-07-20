<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	public function supplier()
	{
		return $this->belongsTo('App\Supplier');
	}

	public function type()
	{
		return $this->belongsTo('App\ProductType','type_id');
	}

	public function __toString()
	{
		return $this->name;
	}
}
