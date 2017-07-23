<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
	protected $fillable=['tid','name','addr','mobile','reffer'];
}
