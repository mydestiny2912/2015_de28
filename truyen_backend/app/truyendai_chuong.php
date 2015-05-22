<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class truyendai_chuong extends Model {
	public $timestamps = false;

	protected $table = 'truyendai_chuong';
	//
	public static function check_exist($tid,$chuong) {
		$check = truyendai_chuong::where("tid","=",$tid)->where("chuong","=",$chuong)->count();
		if ($check > 0) return true; else return false;
	}

		public static function check_chuong($chuong) {
		$check = truyendai_chuong::where("chuong","=",$chuong)->count();
		if ($check > 0) return true; else return false;
		}
}
