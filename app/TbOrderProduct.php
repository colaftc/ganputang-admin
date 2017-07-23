<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TbOrderProduct extends Model
{
	protected $table='tborder_products';
	public function tborder()
	{
		return $this->belongsTo('App\TbOrder','oid');
	}

}
