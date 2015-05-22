<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
class admin extends Model {
	protected $table = 'admin';
	protected $primaryKey = 'adminid';
	public $timestamps = false;
	public static function check_login($inputid, $inputpw) {
		$check = admin::where("username","=",$inputid)->count();
		$admin =  admin::where("username","=",$inputid)->first();
		if (Hash::check($inputpw, $admin->password))
		{
		    $pw = 1;
		} else $pw = 0;
		if ($check > 0 && $pw > 0) return true; else return false;
	}

	public static function check_oldpass($oldpass) {
		$check = admin::where("password","=",$oldpass)->count();
		if ($check > 0) return true; else return false;
	}
	//

}
