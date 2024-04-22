<?php



namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppModel extends Model {

	protected $fillable = [
		'name', 'icon','status'
	];
	protected $table = "appmodel";

	
}
