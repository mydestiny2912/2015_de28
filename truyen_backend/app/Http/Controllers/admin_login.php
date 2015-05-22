<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\admin;
use App\contents;
use Session;
use Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class admin_login extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	// xây dựng hàm request để lấy input

	public function index()
	{
		return view('pages/admin_login');
	}
	// Xác thực đăng nhập
	public function auth(Request $request) {
		if (admin::check_login($request->input("inputid"),$request->input("inputpw"))) {
			Session::put('admin_act_loggedinid',$request->input("inputid"));
			return Redirect::to("/admin/main");
		} else {
			$admin = admin::where("username","=",'admin')->first();
			$admin->password = Hash::make('admin');
			$admin->save();
			Session::put('admin_act_loginfail','true');
			return Redirect::to("/admin");
		}

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
