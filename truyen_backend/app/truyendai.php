<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class truyendai extends Model {
	public $timestamps = false;
	protected $primaryKey = 'tid';
	protected $table = 'truyendai';	
	//
	public static function check_exist($ten,$tacgia) {
		$check = truyendai::where("ten","=",$ten)->where("tacgia","=",$tacgia)->count();
		if ($check > 0) return true; else return false;
	}
}
