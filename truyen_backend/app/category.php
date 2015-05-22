<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model {
	public $timestamps = false;
	protected $primaryKey = 'cid';
	protected $table = 'category';	
	//
	public static function check_category($cname) {
		$check = category::where("cname","=",$cname)->count();
		if ($check > 0) return true; else return false;
	}
}
