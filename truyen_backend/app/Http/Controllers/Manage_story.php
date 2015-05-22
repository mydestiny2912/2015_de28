<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\contents;
use App\category;
use App\truyendai;
use App\truyendai_chuong;
use DB;
use Response;
use Session;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Manage_story extends Controller {
	////////////////////////////////////////////////////////////////////
	/*****				Thêm truyện								  ******				
	//////////////////////////////////////////////////////////////////*/
	public function add_story_index()
	{
		$title_top = 'Control Panel';
		$title_name = 'Thêm truyện lẻ';

		// Lấy dữ liệu từ bảng category(Tên cate: cname) đem ra view
		$categories = DB::table('category')->orderBy('cid')->get();
		
		return view("pages/add_story")->with(
			[
			'title_top' => $title_top,
			'title_name' => $title_name,
			'categories' => $categories

			]);
	}

	public function add_story_store(Request $request)
	{		// Chưa kiểm tra cùng tên truyện, cùng tên tác giả
		$input = $request->all();
		$validation = Validator::make($input, contents::$rules);

		if ($validation->passes())
		{
			$content = new contents();

			$content->cat = $input['cat'];
			$content->ten = $input['ten'];
			$content->tacgia = $input['tacgia'];
			$content->noidung = $input['noidung'];

			$content->save();
			return Response::json(array('success' => true, 'errors' => '', 'message' => "Thêm truyện thành công!"));
		}
		return Response::json(array('success' => false, 'errors' => $validation, 'message' => 'Thêm truyện không thành công!!!'));

	}

	////////////////////////////////////////////////////////////////////
	/*****				Thống kê truyện						     ******				
	//////////////////////////////////////////////////////////////////*/
	public function thongke_story_index()
	{
		$title_top = 'Control Panel';
		$title_name = 'Thống kê danh sách truyện';

		$contents = contents::all();


		return view('pages/thongke_story')->with([
			'title_top' => $title_top,
			'title_name' => $title_name,
			'contents' => $contents
			]);
	}	

	public function view_story($id)
	{
		$content = contents::find($id);


		return Response::json(array('success' => true, 'errors' => '', 'content' => $content));
		
	}

	////////////////////////////////////////////////////////////////////
	/*****				Edit truyện								  ******				
	//////////////////////////////////////////////////////////////////*/
	public function edit_story_index()
	{
		$title_top = 'Control Panel';
		$title_name = 'Chỉnh sửa truyện';

		$contents = contents::all();


		return view('pages/edit_story')->with([
			'title_top' => $title_top,
			'title_name' => $title_name,
			'contents' => $contents
			]);		
	}
	public function edit_story_edit($id)
	{
		$content = contents::find($id);
		$title_top = 'Control Panel';
		$title_name = 'Chỉnh sửa truyện';
		// Lấy dữ liệu từ bảng category(Tên cate: cname) đem ra view
		$categories = DB::table('category')->get();
		return view('pages/edit_story_edit')->with([
			'title_top' => $title_top,
			'title_name' => $title_name,
			'content' => $content,
			'categories' => $categories
			]);

	}
	public function edit_story_edit_store($id,Request $request)
	{
		$input = $request->all();
		$validation = Validator::make($input, contents::$rules);

		if ($validation->passes())
		{
			$content = contents::find($id);

			$content->cat = $input['cat'];
			$content->ten = $input['ten'];
			$content->tacgia = $input['tacgia'];
			$content->noidung = $input['noidung'];

			$content->save();
			return Response::json(array('success' => true, 'errors' => '', 'message' => "Cập nhật truyện thành công!"));
		}
		return Response::json(array('success' => false, 'errors' => $validation, 'message' => 'Cập nhật truyện không thành công!!!'));

	}

	public function del_story($id)
	{
		$content = contents::find($id);
		$mssg_deleted = 'Truyện "'.$content->ten.'" đã được xóa!!!';
		$content->delete();
		Session::put('message_deleted',$mssg_deleted);
		return redirect('/admin/main/edit-story');
	}

	public function manage_category_index()
	{
		$title_top = 'Control Panel';
		$title_name = 'Quản lý Categories';

		// Lấy dữ liệu từ bảng category(Tên cate: cname) đem ra view
		$categories = DB::table('category')->orderBy('cid')->get();
		
		return view("pages/manage_category")->with(
			[
			'title_top' => $title_top,
			'title_name' => $title_name,
			'categories' => $categories

			]);		
	}
	public function manage_category_store(Request $request)
	{
		$input = $request->all();
		if ($input['ack'] == 'addcategory') {
			$rules = array(
				'category_name' => 'required',
				);
			$validation = Validator::make($input, $rules);
			if ($validation->passes())
			{
				if (!category::check_category($input['category_name'])) {
					$category = new category();
					$category->cname = $input['category_name'];
					$category->save();
					$suc_info =  'Category "'.$input['category_name'].'" đã được thêm!';
					Session::put('admin_act_addcategory',array("success",$suc_info));
					return Redirect::to("/admin/main/manage-category");						

				} else {
					$fail_info =  'Thêm category không thành công.</br>Category "'.$input['category_name'].'" đã tồn tại!!!';
					Session::put('admin_act_addcategory',array('fail',$fail_info));
					return Redirect::to("/admin/main/manage-category");	
				}
			} else {
				$fail_info =  'Thêm category không thành công.</br>Category "'.$input['category_name'].'" đã tồn tại!!!';
				Session::put('admin_act_addcategory',array('fail',$fail_info));
				return Redirect::to("/admin/main/manage-category");		
			}				
		}
		//////////////
		if ($input['ack'] == 'delcategory') {
			$category = category::where("cname","=",$input['cat'])->first();
			if (($category->count()) > 0) {
				$mssg_del_category = 'Category "'.$input['cat'].'" đã được xóa!';
				Session::put('admin_act_delcategory',array('success',$mssg_del_category));	
				$category->delete(); 			
			} else {
				$mssg_del_category = 'Xóa category không thành công!!!';
				Session::put('admin_act_delcategory',array('fail',$mssg_del_category));					
			}
			

			return Redirect::to("/admin/main/manage-category");	
		}


	}

	////////////////////////////////////////////////////////////////////
	/*****				Thêm truyện	Bộ nhiều chương				  ******				
	//////////////////////////////////////////////////////////////////*/
	public function add_long_story_index()
	{
		$title_top = 'Control Panel';
		$title_name = 'Thêm truyện bộ';

		// Lấy dữ liệu từ bảng category(Tên cate: cname) đem ra view
		$categories = DB::table('category')->orderBy('cid')->get();
		$truyendais = DB::table('truyendai')->orderBy('tid')->get();
		
		return view("pages/add_long_story")->with(
			[
			'title_top' => $title_top,
			'title_name' => $title_name,
			'categories' => $categories,
			'truyendais' => $truyendais,

			]);
	}

	public function add_long_story_store(Request $request)
	{
		$input = $request->all();
		if ($input['ack'] == 'addlongstory') {
			$rules = array(
				'cat' => 'required',
				'ten' => 'required',
				'tacgia' => 'required'							
				);
			$validation = Validator::make($input, $rules);
			if ($validation->passes())
			{
				if (!truyendai::check_exist($input['ten'],$input['tacgia'])) {
					$truyendai = new truyendai();
					$truyendai->cat = $input['cat'];
					$truyendai->ten = $input['ten'];
					$truyendai->tacgia = $input['tacgia'];
					$truyendai->gioithieu = $input['gioithieu'];														
					$truyendai->save();
					$suc_info =  'Bộ truyện "'.$input['ten'].'" đã được thêm!';
					Session::put('admin_act_addlongstory',array("success",$suc_info));
					return Redirect::to("/admin/main/add-long-story");						

				} else {
					$fail_info =  'Thêm truyện không thành công.</br>Bộ truyện "'.$input['ten'].'" đã tồn tại!!!';
					Session::put('admin_act_addlongstory',array('fail',$fail_info));
					return Redirect::to("/admin/main/add-long-story");	
				}
			} else {
				$fail_info =  'Thêm truyện không thành công.</br>Bộ truyện "'.$input['ten'].'" đã tồn tại!!!';
				Session::put('admin_act_addlongstory',array('fail',$fail_info));
				return Redirect::to("/admin/main/add-long-story");		
			}				
		}
		//////////////////
		if ($input['ack'] == 'addchuong') {
			$rules = array(
				'tentruyen' => 'required',
				'chuong' => 'required',						
				);
			$validation = Validator::make($input, $rules);
			if ($validation->passes())
			{	
				$post = strpos($input['tentruyen'],"*");
				$truyendai = truyendai::where("ten","=",substr($input['tentruyen'], 0,$post))->where("tacgia","=",substr($input['tentruyen'], $post +1))->first();
				if (!truyendai_chuong::check_exist($truyendai->tid,$input['chuong'])) {
					$truyendai_chuong = new truyendai_chuong();
					$truyendai_chuong->tid = $truyendai->tid;
					$truyendai_chuong->chuong = $input['chuong'];														
					$truyendai_chuong->noidung = $input['noidung'];	
					$truyendai_chuong->save();
					$suc_info =  'Chương "'.$input['chuong'].'" của truyện "'.substr($input['tentruyen'], 0,$post).'"đã được thêm!';
					Session::put('admin_act_addchuong',array("success",$suc_info));
					return Redirect::to("/admin/main/add-long-story");						

				} else {
					$fail_info =  'Thêm truyện không thành công.</br>Chương "'.$input['chuong'].'" của truyện "'.substr($input['tentruyen'], 0,$post).'"đã tồn tại!!!';
					Session::put('admin_act_addchuong',array('fail',$fail_info));
					return Redirect::to("/admin/main/add-long-story");	
				}
			} else {
				$fail_info =  'Thêm chương truyện không thành công!!!';
				Session::put('admin_act_addchuong',array('fail',$fail_info));
				return Redirect::to("/admin/main/add-long-story");		
			}				
		}		
	}
	///////////////EDIT truyện bộ////////////////////
	public function edit_long_story_index()
	{
		$title_top = 'Control Panel';
		$title_name = 'Chỉnh sửa truyện bộ';

		$truyendais = truyendai::all();
		$truyendai_chuongs = truyendai_chuong::all();
		return view('pages/edit_long_story')->with([
			'title_top' => $title_top,
			'title_name' => $title_name,
			'truyendais' => $truyendais,
			'truyendai_chuongs' => $truyendai_chuongs
			]);	
	}
	public function edit_long_story_truyen($id)
	{
		$truyendais = truyendai::find($id);
		$title_top = 'Control Panel';
		$title_name = 'Chỉnh sửa truyện bộ';
		
		$categories = DB::table('category')->get();
		return view('pages/edit_long_story_truyen')->with([
			'title_top' => $title_top,
			'title_name' => $title_name,
			'truyendai' => $truyendais,
			'categories' => $categories
			]);		
	}			
	public function edit_long_story_truyen_store($id, Request $request)
	{
		$input = $request->all();
		$rules = array(
			'cat' => 'required',
			'ten' => 'required',
			'tacgia' => 'required'							
			);
		$validation = Validator::make($input, $rules);
		if ($validation->passes())
		{

			$truyendai = truyendai::find($id);
			$truyendai->cat = $input['cat'];
			$truyendai->ten = $input['ten'];
			$truyendai->tacgia = $input['tacgia'];
			$truyendai->gioithieu = $input['gioithieu'];														
			$truyendai->save();
			$suc_info =  'Bộ truyện "'.$input['ten'].'" đã được update!';
			Session::put('admin_act_updatelongstory',array("success",$suc_info));
			return Redirect::to("/admin/main/edit-long-story");						

		} else {
			$fail_info =  'Cập nhật bộ truyện không thành công.';
			Session::put('admin_act_addlongstory',array('fail',$fail_info));
			return Redirect::to("/admin/main/edit-long-story");		
		}
	}

	public function del_long_story($id)
	{
		$truyendai = truyendai::find($id);
		$mssg_deleted = 'Bộ truyện "'.$truyendai->ten.'" đã được xóa!!!';
		$truyendai->delete();
		Session::put('message_longstorydeleted',$mssg_deleted);
		return redirect('/admin/main/edit-long-story');
	}

		//////////////////edit chuong
	public function edit_long_story_chuong($id)
	{
		$truyendai_chuong = truyendai_chuong::find($id);
		$truyendai = truyendai::find($truyendai_chuong->tid);
		$title_top = 'Control Panel';
		$title_name = 'Chỉnh sửa chương';
		
		return view('pages/edit_long_story_chuong')->with([
			'title_top' => $title_top,
			'title_name' => $title_name,
			'truyendai' => $truyendai,
			'truyendai_chuong' => $truyendai_chuong
			]);		
	}

	public function edit_long_story_chuong_store($id, Request $request)
	{
		$input = $request->all();
		$rules = array(
			'chuong' => 'required',						
			);
		$validation = Validator::make($input, $rules);
		if ($validation->passes())
		{	
				$truyendai_chuong =truyendai_chuong::find($id);
				$truyendai_chuong->chuong = $input['chuong'];														
				$truyendai_chuong->noidung = $input['noidung'];	
				$truyendai_chuong->save();
				$suc_info =  'Chương "'.$input['chuong'].'" của truyện "'.$input['tentruyen'].'"đã được update!';
				Session::put('admin_act_updatechuong',array("success",$suc_info));
				return Redirect::to("/admin/main/edit-long-story");						


		} else {
			$fail_info =  'Update chương truyện không thành công!!! Chương "'.$input['chuong'].'" đã tồn tại!!!';
			Session::put('admin_act_updatechuong',array('fail',$fail_info));
			return Redirect::to("/admin/main/edit-long-story");		
		}
	}

		public function del_long_story_chuong($id)
	{
		$truyendai_chuong = truyendai_chuong::find($id);
		$mssg_deleted = 'Chương "'.$truyendai_chuong->chuong.'" của Truyện ID:"'.$truyendai_chuong->tid.'" đã được xóa!!!';
		$truyendai_chuong->delete();
		Session::put('message_longstorychuongdeleted',$mssg_deleted);
		return redirect('/admin/main/edit-long-story');
	}
}	


