<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpensesType extends Model
{
	protected $table='expenses_type';
	public function __toString()
	{
		return $this->name;
	}

	public function expenditures()
	{
		return $this->hasMany('App\Expenditure','type_id');
	}
}
