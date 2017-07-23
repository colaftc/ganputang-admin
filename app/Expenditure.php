<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenditure extends Model
{
	protected $table='expenditure';
	public function type()
	{
		return $this->belongsTo('App\ExpensesType');
	}

	public function shop()
	{
		return $this->belongsTo('App\Shop');
	}
}
