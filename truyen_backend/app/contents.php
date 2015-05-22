<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class contents extends Model {
public $timestamps = false;
	protected $table = 'contents';
    public static $rules = array(
        'cat' => 'required',
        'ten' => 'required',
        'tacgia' => 'required'

    );
	

}
