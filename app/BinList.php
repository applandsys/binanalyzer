<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BinList extends Model
{
   protected $fillable = [
		'binprefix', 'country','bank', 'brand', 'type', 'sub_brand', 'prepaid','comments',
	];
}
