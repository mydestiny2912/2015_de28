<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;
use App\admin;
use App\users;
use App\comments;
use Redirect;
class Manage_account extends Controller {


	public function changepass_admin_index()
	{
		$title_top = 'Control Panel';
		$title_name = 'Đổi mật khẩu Admin';

		return view("pages/changepass_admin")->with(
			[
			'title_top' => $title_top,
			'title_name' => $title_name,

			]);
	}
	public function changepass_admin_store(Request $request)
	{
		$input = $request->all();
		$rules = array(
			'oldpass' => 'required',
			'confirm_newpass' => 'required'
			);
		$validation = Validator::make($input, $rules);
		if ($validation->passes())
		{
			if (admin::check_oldpass(md5($input["oldpass"]))) {
				$admin = admin::where('username', '=', $input['username_admin'])->first();
				$admin->password = md5($input['confirm_newpass']);
				$admin->save();
				Session::put('admin_act_changepass','success');
				return Redirect::to("/admin/main/changepass-admin");
			} else {
				Session::put('admin_act_changepass','fail');
				return Redirect::to("/admin/main/changepass-admin");
			}
		} else {
			Session::put('admin_act_changepass','fail');
			return Redirect::to("/admin/main/changepass-admin");
		}
	}

	////////////Tạo tài khoản/////////////////
	public function add_user_index()
	{
		$title_top = 'Control Panel';
		$title_name = 'Tạo tài khoản User';

		return view("pages/add_user")->with(
			[
			'title_top' => $title_top,
			'title_name' => $title_name,

			]);
	}

	public function add_user_store(Request $request)
	{
		$input = $request->all();
		$rules = array(
			'username' => 'required',
			'password' => 'required',
			'repassword' => 'required',
			'lastname' => 'required',
			'firstname' => 'required',
			'email' => 'email',
			);
		$validation = Validator::make($input, $rules);
		if ($validation->passes())
		{
			$users = new users();
			$users->username = $input['username'];
			$users->password = md5($input['repassword']);
			$users->lastname = $input['lastname'];
			$users->firstname = $input['firstname'];
			$users->email = $input['email'];
			$users->save();	

			$suc_info =  'Tài khoản "'.$input['username'].'" đã được tạo!';
			Session::put('admin_act_adduser',array("success",$suc_info));
			return Redirect::to("/admin/main/add-user");						

		}  else {
			$fail_info =  'Tạo tài khoản không thành công.</br>Username "'.$input['username'].'" đã tồn tại!!!';
			Session::put('admin_act_adduser',array('fail',$fail_info));
			return Redirect::to("/admin/main/add-user");
		}	
	}
	////////////CHỉnh sửa tài khoản/////////////////
	public function edit_user_index()
	{
		$title_top = 'Control Panel';
		$title_name = 'Chỉnh sửa tài khoản';

		$users = users::all();


		return view('pages/edit_user')->with([
			'title_top' => $title_top,
			'title_name' => $title_name,
			'users' => $users
			]);		
	}
	public function edit_user_edit($id)
	{
		$users = users::find($id);
		$title_top = 'Control Panel';
		$title_name = 'Chỉnh sửa Tài khoản';

		return view('pages/edit_user_edit')->with([
			'title_top' => $title_top,
			'title_name' => $title_name,
			'users' => $users,
			]);		
	}	

	public function edit_user_edit_store($id,Request $request)
	{
		$input = $request->all();
		$rules = array(
			'username' => 'required',
			'password' => 'required',
			'repassword' => 'required',
			'lastname' => 'required',
			'firstname' => 'required',
			'email' => 'email',
			);
		$validation = Validator::make($input, $rules);

		if ($validation->passes())
		{	$users = users::find($id);
			if ($input['repassword'] == 'abcd') {

				$users->username = $input['username'];
				$users->lastname = $input['lastname'];
				$users->firstname = $input['firstname'];
				$users->email = $input['email'];
				$users->save();			
			} else {
				$users->username = $input['username'];
				$users->password = md5($input['repassword']);
				$users->lastname = $input['lastname'];
				$users->firstname = $input['firstname'];
				$users->email = $input['email'];
				$users->save();	
			}
			$suc_info =  'Tài khoản "'.$input['username'].'" đã được chỉnh sửa!';
			Session::put('admin_act_edituser',array("success",$suc_info));
			return Redirect::to("/admin/main/edit-user");						

		}  else {
			$fail_info =  'Edit tài khoản không thành công.</br>Username "'.$input['username'].'" đã tồn tại!!!';
			Session::put('admin_act_edituser',array('fail',$fail_info));
			return Redirect::to("/admin/main/edit-user");
		}

	}
	public function del_user($id)
	{
		$users = users::find($id);
		$mssg_deleted = 'Tài khoản "'.$users->username.'" đã được xóa!!!';
		$users->delete();
		Session::put('message_userdeleted',$mssg_deleted);
		return redirect('/admin/main/edit-user');
	}

	//////////////// Manage Comment/////////////////////////
	public function edit_comment_index()
	{
		$title_top = 'Control Panel';
		$title_name = 'Chỉnh sửa comment';

		$comments = comments::all();


		return view('pages/edit_comment')->with([
			'title_top' => $title_top,
			'title_name' => $title_name,
			'comments' => $comments
			]);		
	}
}
