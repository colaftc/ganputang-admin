<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TbOrder extends Model
{
	protected $table='tborders';
	public function products()
	{
		return $this->hasMany('App\TbOrderProduct','oid');
	}

	public function scopeCompleted($query)
	{
		return $query->where('status','交易成功');
	}

	public function scopeRemarked($query)
	{
		return $query->whereNotNull('remarks');
	}
}
