<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

/*Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	]);*/

// add them
Route::filter('check-current',function() {
	if (Session::has('admin_act_loggedinid')) {
		return Redirect::to('admin/main');
	}
});
Route::get('admin',array('before' => 'check-current','uses' => 'admin_login@index'));
Route::post('admin','admin_login@auth');
Route::get('admin/logout',function(){
	Session::forget('admin_act_loggedinid');
	return Redirect::to('admin');
});

// Check nếu ko có session login thì chuyển tới đăng nhập
Route::filter('check-login',function(){
	if (!Session::has('admin_act_loggedinid')) {
		return Redirect::to('admin');
	}
});
Route::group(array('before' => 'check-login'), function() {
	Route::get('/admin/main', 'Main_Controller@index');
	Route::get('/admin/main/add-story', 'Manage_story@add_story_index');
	Route::get('/admin/main/thongke-story', 'Manage_story@thongke_story_index');
	Route::get('/admin/main/edit-story', 'Manage_story@edit_story_index');
	Route::get('/admin/main/edit-story/edit/{id}',array('as' => 'editstory','uses' => 'Manage_story@edit_story_edit' ));
	Route::get('/admin/main/edit-story/del/{id}',array('as' => 'delstory','uses' => 'Manage_story@del_story'));
	Route::get('/admin/main/view-story/{id}',array('as' => 'viewstory','uses' => 'Manage_story@view_story'));
	Route::get('/admin/main/manage-category','Manage_story@manage_category_index');
	// Truyện bộ
	Route::get('/admin/main/add-long-story', 'Manage_story@add_long_story_index');
	Route::get('/admin/main/edit-long-story', 'Manage_story@edit_long_story_index');
	Route::get('/admin/main/edit-long-story/edit/{id}',array('as' => 'editlongstory_truyen','uses' => 'Manage_story@edit_long_story_truyen' ));
	Route::get('/admin/main/edit-long-story/del/{id}',array('as' => 'dellongstory','uses' => 'Manage_story@del_long_story'));
	Route::get('/admin/main/edit-long-story-chuong/edit/{id}',array('as' => 'editlongstory_chuong','uses' => 'Manage_story@edit_long_story_chuong' ));
	Route::get('/admin/main/edit-long-story-chuong/del/{id}',array('as' => 'dellongstory_chuong','uses' => 'Manage_story@del_long_story_chuong'));
	// Manage Account
	Route::get('/admin/main/changepass-admin','Manage_account@changepass_admin_index');
	Route::get('/admin/main/add-user','Manage_account@add_user_index');
	Route::get('/admin/main/edit-user','Manage_account@edit_user_index');
	Route::get('/admin/main/edit-user/edit/{id}',array('as' => 'edituser','uses' => 'Manage_account@edit_user_edit' ));
	Route::get('/admin/main/edit-user/del/{id}',array('as' => 'deluser','uses' => 'Manage_account@del_user'));
	// Manage comment
	Route::get('/admin/main/edit-comment', 'Manage_account@edit_comment_index');
	Route::get('/admin/main/edit-comment/edit/{id}',array('as' => 'editcomment','uses' => 'Manage_account@edit_comment_edit' ));
	Route::get('/admin/main/edit-comment/del/{id}',array('as' => 'delcomment','uses' => 'Manage_account@del_comment'));		
});

// Add truyện POST
Route::post('/admin/main/add-story', 'Manage_story@add_story_store');
Route::post('/admin/main/edit-story/edit/{id}',array('as' => 'editstory_post','uses' => 'Manage_story@edit_story_edit_store'));
//Route::post('/admin/main/edit-story/del/{id}',array('as' => 'delstory_post','uses' => 'Manage_story@del_story_post'));
Route::post('/admin/main/changepass-admin','Manage_account@changepass_admin_store');
Route::post('/admin/main/manage-category','Manage_story@manage_category_store');
Route::post('/admin/main/add-long-story', 'Manage_story@add_long_story_store');
Route::post('/admin/main/edit-long-story/edit/{id}',array('as' => 'editlongstory_truyen_post','uses' => 'Manage_story@edit_long_story_truyen_store' ));
Route::post('/admin/main/edit-long-story-chuong/edit/{id}',array('as' => 'editlongstory_chuong_post','uses' => 'Manage_story@edit_long_story_chuong_store' ));
Route::post('/admin/main/add-user','Manage_account@add_user_store');
// Manageaccount
Route::post('/admin/main/edit-user/edit/{id}',array('as' => 'edituser_post','uses' => 'Manage_account@edit_user_edit_store' ));
//Manage comment
Route::post('/admin/main/edit-comment/edit/{id}',array('as' => 'editcomment_post','uses' => 'Manage_account@edit_comment_edit_store' ));


