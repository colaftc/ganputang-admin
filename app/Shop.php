<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
	protected $table='shop';
	public function __toString()
	{
		return $this->name;
	}

	public function exprnditures()
	{
		return $this->hasMany('App\Expenditure','shop_id');
	}
}
