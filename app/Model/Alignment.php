<?php


namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alignment extends Model {
	use SoftDeletes;

	protected $table = "alignment";

}
